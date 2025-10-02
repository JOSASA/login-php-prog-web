<?php
// logout.php
session_start();
session_destroy();
// Redirigir a la página de inicio después de cerrar sesión
header('Location: ../index.php');
exit;
?>