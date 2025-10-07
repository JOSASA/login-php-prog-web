<?php
// Iniciar la sesión para poder acceder a ella
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión del servidor
session_destroy();

// 🍪 Borrar las cookies de "Recordarme"
// Se hace estableciendo una fecha de expiración en el pasado.
if (isset($_COOKIE['remember_me_id'])) {
    unset($_COOKIE['remember_me_id']);
    setcookie('remember_me_id', '', time() - 3600, '/'); // Tiempo en el pasado
}
if (isset($_COOKIE['remember_me_token'])) {
    unset($_COOKIE['remember_me_token']);
    setcookie('remember_me_token', '', time() - 3600, '/'); // Tiempo en el pasado
}

// Redirigir al usuario
header('Location: ../index.php');
exit();
?>