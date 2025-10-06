<?php


// Verificamos que la solicitud sea por POST y que los datos necesarios existan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    
    $id = $_POST['id'];
    $action = $_POST['action'];

    // Verificamos que el producto exista en el carrito
    if (isset($_SESSION['carrito'][$id])) {
        
        if ($action == 'sumar') {
            $_SESSION['carrito'][$id]['cantidad']++;
        } elseif ($action == 'restar') {
            $_SESSION['carrito'][$id]['cantidad']--;

            // Si la cantidad llega a 0, eliminamos el producto del carrito
            if ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$id]);
            }
        }
    }
}

// Redirigimos siempre de vuelta a la página del carrito para ver los cambios
header('Location: ../carrito.php');
exit();