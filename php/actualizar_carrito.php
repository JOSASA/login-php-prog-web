<?php
// actualizar_carrito.php
session_start();

// Validamos que se envíe un ID y una acción
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['action'])) {
    
    $id_producto = $_POST['id'];
    $action = $_POST['action'];

    // Nos aseguramos de que el producto esté en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        
        // Obtenemos la cantidad actual
        $cantidad_actual = $_SESSION['carrito'][$id_producto]['cantidad'];

        if ($action == 'sumar') {
            // Si la acción es sumar, incrementamos en 1
            $_SESSION['carrito'][$id_producto]['cantidad']++;
        } elseif ($action == 'restar') {
            // Si la acción es restar, decrementamos en 1
            $_SESSION['carrito'][$id_producto]['cantidad']--;
            
            // Si la cantidad llega a 0, eliminamos el producto del carrito
            if ($_SESSION['carrito'][$id_producto]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id_producto]);
            }
        }
    }
}

// Redirigir siempre de vuelta al carrito para que vea los cambios
header('Location: ../carrito.php');
exit;
?>