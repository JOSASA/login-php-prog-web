<?php
// ¡MUY IMPORTANTE! session_start() debe ser la primera línea de código.
session_start();

// --- NUEVO: Incluimos la conexión a la base de datos ---
// Asegúrate de que la ruta a tu archivo de conexión sea la correcta.
require 'dbconnect.php';

// 1. Verificar que se está enviando el formulario por el método POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 2. Recoger y validar los datos del formulario (esto no cambia).
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    $imagen = filter_input(INPUT_POST, 'imagen', FILTER_SANITIZE_URL);

    if ($id === false || $nombre === null || $precio === false || $cantidad === false || $imagen === null) {
        header('Location: ../shop.php?status=error_datos');
        exit();
    }

    // 3. Lógica de la sesión (esto no cambia).
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

    // --- NUEVO: LÓGICA DE PERSISTENCIA EN LA BASE DE DATOS ---
    // 4. Verificamos si el usuario ha iniciado sesión.
    //    (Asumimos que guardas su ID en $_SESSION['usuario_id'] al hacer login).
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        $producto_id = $id;

        // Buscamos si el producto ya está en el carrito de la BD para este usuario.
        $stmt = $conn->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $item_existente = $resultado->fetch_assoc();
        $stmt->close();

        if ($item_existente) {
            // Si ya existe, actualizamos la cantidad en la base de datos.
            $nueva_cantidad = $item_existente['cantidad'] + $cantidad;
            $stmt_update = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
            $stmt_update->bind_param("ii", $nueva_cantidad, $item_existente['id']);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            // Si no existe, insertamos un nuevo registro en la base de datos.
            $stmt_insert = $conn->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
            $stmt_insert->execute();
            $stmt_insert->close();
        }
    }
    // --- FIN DE LA LÓGICA DE BASE DE DATOS ---

    // 5. Redirigir al usuario (esto no cambia).
    header('Location: ../shop.php?status=success');
    exit();

} else {
    header('Location: ../index.php');
    exit();
}