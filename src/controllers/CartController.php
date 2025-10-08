<?php
// src/controllers/CartController.php

/**
 * Agrega un producto al carrito (sesión y BD).
 * Contiene la lógica de tu 'agregar_al_carrito.php'.
 */

// src/controllers/CartController.php

/**
 * Agrega un producto al carrito (sesión y BD).
 * Se activa con la acción 'cart_add'.
 */
function handle_add_to_cart($conn) {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header('Location: ' . BASE_URL . 'index.php');
        exit();
    }
    
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    $imagen = filter_input(INPUT_POST, 'imagen', FILTER_SANITIZE_URL);

    if ($id === false || empty($nombre) || $precio === false || $cantidad === false || empty($imagen)) {
        header('Location: ' . BASE_URL . 'index.php?route=shop&status=error_datos');
        exit();
    }

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = [
            'nombre'   => $nombre,
            'precio'   => $precio,
            'cantidad' => $cantidad,
            'imagen'   => $imagen
        ];
    }

    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id'];
        $producto_id = $id;

        $stmt = $conn->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
        $item_existente = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($item_existente) {
            $nueva_cantidad_total = $_SESSION['carrito'][$id]['cantidad'];
            $stmt_update = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
            $stmt_update->bind_param("ii", $nueva_cantidad_total, $item_existente['id']);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            $stmt_insert = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
            $stmt_insert->execute();
            $stmt_insert->close();
        }
    }

    header('Location: ' . BASE_URL . 'index.php?route=cart&status=added');
    exit();
}

/**
 * Actualiza la cantidad de un producto en el carrito (+/-).
 * Se activa con la acción 'cart_update'.
 */
function handle_update_cart($conn) {
    if (!isset($_POST['id'], $_POST['update_action'])) {
        header('Location: ' . BASE_URL . 'index.php?route=cart&status=error');
        exit();
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $update_action = $_POST['update_action']; // 'sumar' o 'restar'

    if (!$id || !isset($_SESSION['carrito'][$id])) {
        header('Location: ' . BASE_URL . 'index.php?route=cart');
        exit();
    }

    if ($update_action === 'sumar') {
        $_SESSION['carrito'][$id]['cantidad']++;
    } elseif ($update_action === 'restar') {
        $_SESSION['carrito'][$id]['cantidad']--;
    }

    if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
        unset($_SESSION['carrito'][$id]);
    }

    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id'];
        if (isset($_SESSION['carrito'][$id])) {
            $nueva_cantidad = $_SESSION['carrito'][$id]['cantidad'];
            $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
            $stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $id);
        } else {
            $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $id);
        }
        $stmt->execute();
        $stmt->close();
    }

    header('Location: ' . BASE_URL . 'index.php?route=cart');
    exit();
}


/**
 * Elimina un producto del carrito por completo.
 * Se activa con la ruta 'cart_remove'.
 */
function handle_remove_from_cart($conn) {
    if (!isset($_GET['id'])) {
        header('Location: ' . BASE_URL . 'index.php?route=cart');
        exit();
    }
    
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if ($id) {
        unset($_SESSION['carrito'][$id]);
        
        if (isset($_SESSION['id'])) {
            $usuario_id = $_SESSION['id'];
            $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $id);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    header('Location: ' . BASE_URL . 'index.php?route=cart&status=removed');
    exit();
}

// ... (la función sync_cart_from_db_on_login no necesita cambios) ...
function sync_cart_from_db_on_login($conn, $usuario_id) {
    $_SESSION['carrito'] = []; // Limpiamos carrito de sesión.

    $sql = "SELECT p.id, p.nombre, p.precio, p.imagen, c.cantidad 
            FROM carrito c 
            JOIN productos p ON c.producto_id = p.id 
            WHERE c.usuario_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($item = $resultado->fetch_assoc()) {
        $_SESSION['carrito'][$item['id']] = [
            'nombre'   => $item['nombre'],
            'precio'   => $item['precio'],
            'cantidad' => $item['cantidad'],
            'imagen'   => $item['imagen']
        ];
    }
    $stmt->close();
}
?>