<?php
session_start();
require 'dbconnect.php'; // Conexión a la BD

// 1. Validar que los datos POST existen
if (!isset($_POST['id'], $_POST['action'])) {
    header('Location: ../carrito.php?status=error_datos');
    exit();
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$action = $_POST['action']; // 'sumar' o 'restar'

// Si el ID no es válido o el producto no está en el carrito, redirigir
if (!$id || !isset($_SESSION['carrito'][$id])) {
    header('Location: ../carrito.php');
    exit();
}

// 2. Lógica para actualizar la cantidad en la SESIÓN
if ($action === 'sumar') {
    $_SESSION['carrito'][$id]['cantidad']++;
} elseif ($action === 'restar') {
    $_SESSION['carrito'][$id]['cantidad']--;
}

// 3. Si la cantidad es 0 o menos, eliminar el producto
if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
    unset($_SESSION['carrito'][$id]);
}

// 4. Sincronizar con la BASE DE DATOS si el usuario está logueado
if (isset($_SESSION['id'])) { // Usamos 'id' como en tu script de login
    $usuario_id = $_SESSION['id'];

    // Verificamos si el producto todavía existe en el carrito de la sesión
    if (isset($_SESSION['carrito'][$id])) {
        // Si existe, actualizamos su cantidad
        $nueva_cantidad = $_SESSION['carrito'][$id]['cantidad'];
        $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Si ya no existe en la sesión (porque su cantidad llegó a 0), lo eliminamos de la BD
        $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// 5. Redirigir de vuelta al carrito
header('Location: ../carrito.php');
exit();