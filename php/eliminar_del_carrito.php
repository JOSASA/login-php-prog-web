<?php

// 1. Incluimos TU archivo de conexión
require './php/dbconnect.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lógica de sesión (se mantiene igual)
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
    
    // Lógica de persistencia en BD
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        $producto_id = $id;
        
        // Eliminamos el producto de la tabla 'carrito' para ese usuario
        // 2. Usamos $conn en lugar de $mysqli
        $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
        $stmt->close(); // Cerramos el statement
    }
}

header('Location: ../carrito.php');
exit();