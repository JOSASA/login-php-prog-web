<?php
// Es crucial iniciar la sesión al principio de cualquier página que la use.
session_start();

// ===== 1. SEGURIDAD: PROTEGER LA PÁGINA =====
// Si el usuario no ha iniciado sesión, redirigirlo a la página de login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit; // Detenemos la ejecución del script.
}
//pero si el encuentro cookies=


// ===== 2. OBTENER DATOS DEL USUARIO DE LA BASE DE DATOS =====
// Incluimos el archivo de conexión que ya debes tener.
require './php/dbconnect.php';

// Obtenemos el ID del usuario que está en la sesión.
$id_usuario = $_SESSION['id'];

// Preparamos una consulta segura para obtener los datos del usuario.
// Usamos una consulta preparada para evitar inyecciones SQL.
$stmt = $conn->prepare("SELECT nombre, email,direccion, telefono, creado_en FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_usuario); // "i" porque el ID es un entero.
$stmt->execute();
$resultado = $stmt->get_result();

// Si no encontramos al usuario (aunque es raro si la sesión está activa), mostramos un error.
if ($resultado->num_rows === 0) {
    exit('No se encontró el usuario en la base de datos.');
}

// Guardamos los datos del usuario en una variable.
$user = $resultado->fetch_assoc();

$stmt->close();
$conn->close();
?>