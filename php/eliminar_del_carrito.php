<?php
// eliminar_del_carrito.php
session_start();

if (isset($_GET['id'])) {
    $id_a_eliminar = $_GET['id'];
    if (isset($_SESSION['carrito'][$id_a_eliminar])) {
        unset($_SESSION['carrito'][$id_a_eliminar]);
    }
}

header('Location: carrito.php');
exit;
?>