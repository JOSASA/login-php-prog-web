<?php
// Iniciar la sesión es importante para que el carrito funcione.
¿

// 1. CONEXIÓN Y CONSULTA A LA BASE DE DATOS
// ===============================================
require './php/dbconnect.php'; // Incluimos tu archivo de conexión

// Preparamos la consulta para obtener todos los productos
// Los ordenamos por ID de forma descendente para mostrar los más nuevos primero
$sql = "SELECT id, nombre, descripcion, precio, stock, imagen FROM productos ORDER BY id DESC";

// Ejecutamos la consulta
$resultado = $conn->query($sql);
// ===============================================
?>