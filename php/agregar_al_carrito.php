<?php
// agregar_al_carrito.php

session_start();

// 1. Validar que se recibieron los datos esperados
if (
    !isset($_POST['id'], $_POST['nombre'], $_POST['precio'], $_POST['cantidad']) ||
    !is_numeric($_POST['id']) ||
    !is_numeric($_POST['precio']) ||
    !is_numeric($_POST['cantidad'])
) {
    // Si no se reciben los datos o no son válidos, no hacemos nada o mostramos un error.
    die('Datos del producto no válidos.');
}

// 2. Recuperar los datos del producto
$id_producto = (int)$_POST['id'];
$nombre_producto = $_POST['nombre'];
$precio_producto = (float)$_POST['precio'];
$cantidad = (int)$_POST['cantidad'];

// 3. Inicializar el carrito en la sesión si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// 4. Lógica para agregar el producto
// Si el producto ya está en el carrito, actualizamos la cantidad
if (isset($_SESSION['carrito'][$id_producto])) {
    $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
} else {
    // Si es un producto nuevo, lo agregamos al carrito
    $_SESSION['carrito'][$id_producto] = [
        'nombre' => $nombre_producto,
        'precio' => $precio_producto,
        'cantidad' => $cantidad,
        'imagen' => $_POST['imagen'] // Opcional: guardar la imagen
    ];
}

// 5. Redirigir al usuario de vuelta a la página de productos
header('Location: ../shop.php');
exit;
?>