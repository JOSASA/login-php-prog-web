<?php
// src/controllers/PageController.php

// Muestra la página de inicio
function show_home_page($conn) {
    // Puedes obtener productos destacados aquí si quieres
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/home.php';
    include_once '../src/views/layouts/footer.php';
}

// Muestra la página de la tienda
function show_shop_page($conn) {
    // La lógica que tenías al inicio de shop.php para obtener productos
    $sql = "SELECT id, nombre, descripcion, precio, stock, imagen FROM productos ORDER BY id DESC";
    $resultado = $conn->query($sql);
    
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/shop.php';
    include_once '../src/views/layouts/footer.php';
}

// Muestra la página de un solo producto
function show_shop_single_page($conn) {
    // La lógica que tenías al inicio de shop-single.php para obtener un producto por ID
    // ...
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/shop-single.php';
    include_once '../src/views/layouts/footer.php';
}

// Muestra el carrito
function show_cart_page($conn) {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/cart.php';
    include_once '../src/views/layouts/footer.php';
}

// ...y así para cada página (profile, contact, etc.)...
// Las páginas simples solo necesitan incluir los archivos de la vista.
function show_login_page() {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/login.php';
    include_once '../src/views/layouts/footer.php';
}

function show_register_page() {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/register.php';
    include_once '../src/views/layouts/footer.php';
}

function show_checkout_page($conn) {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/checkout.php';
    include_once '../src/views/layouts/footer.php';
}

function show_profile_page($conn) {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/profile.php';
    include_once '../src/views/layouts/footer.php';
}
function show_contact_page() {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/contact.php';
    include_once '../src/views/layouts/footer.php';
}
function show_about_page() {
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/about.php';
    include_once '../src/views/layouts/footer.php';
}