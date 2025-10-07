<?php
session_start();
require 'dbconnect.php'; // Conexión a la BD

// 1. Validar que se recibió un ID por GET
if (!isset($_GET['id'])) {
    header('Location: ../carrito.php?status=no_id');
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../carrito.php');
    exit();
}

// 2. Eliminar de la SESIÓN
unset($_SESSION['carrito'][$id]);

// 3. Eliminar de la BASE DE DATOS si el usuario está logueado
if (isset($_SESSION['id'])) {
    $usuario_id = $_SESSION['id'];
    $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $id);
    $stmt->execute();
    $stmt->close();
}

// 4. Redirigir de vuelta al carrito
header('Location: ../carrito.php?status=eliminado');
exit();