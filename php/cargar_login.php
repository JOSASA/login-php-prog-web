<?php
session_start();
// 1. Incluimos TU archivo de conexión
require './php/dbconnect.php';

// ... (Aquí iría tu lógica real para verificar usuario y contraseña) ...
// Supongamos que el login es exitoso y obtienes el ID del usuario
$usuario_id_logueado = 1; // Ejemplo

// Guardamos el ID del usuario en la sesión
$_SESSION['usuario_id'] = $usuario_id_logueado;

// --- CARGAR CARRITO DESDE LA BD ---
// Limpiamos el carrito de sesión actual para no duplicar
$_SESSION['carrito'] = [];

// Preparamos la consulta
$sql = "SELECT p.id, p.nombre, p.precio, p.imagen, c.cantidad 
        FROM carrito c 
        JOIN productos p ON c.producto_id = p.id 
        WHERE c.usuario_id = ?";

// 2. Usamos $conn en lugar de $mysqli
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id_logueado);
$stmt->execute();
$resultado = $stmt->get_result();

// Llenamos la sesión con los datos de la base de datos
while ($item = $resultado->fetch_assoc()) {
    $_SESSION['carrito'][$item['id']] = [
        'nombre'   => $item['nombre'],
        'precio'   => $item['precio'],
        'cantidad' => $item['cantidad'],
        'imagen'   => $item['imagen']
    ];
}
$stmt->close(); // Cerramos el statement

// Redirigimos al usuario
header('Location: ../index.php');
exit();