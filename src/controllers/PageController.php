<?php
// src/controllers/PageController.php

/**
 * Muestra la página de inicio.
 * Llama al ProductController para obtener los productos destacados.
 */
function show_home_page($conn) {
    $page_title = "Inicio - eBrainrot";
    
    // Obtenemos los datos necesarios para esta página.
    require_once '../src/controllers/ProductController.php';
   
    
    // Construimos la página.
    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/home.php';
    include_once '../src/views/layouts/footer.php';
}

/**
 * Muestra la página de la tienda, con filtros.
 */
function show_shop_page($conn) {
    $page_title = "Tienda";
    
    // Obtenemos los datos necesarios.
    require_once '../src/controllers/ProductController.php';
    $categoria_filtro = $_GET['categoria'] ?? null;
    $orden_filtro = $_GET['orden'] ?? 'newest';
    $productos = get_all_products($conn, $categoria_filtro, $orden_filtro);
    $categorias = get_all_categories($conn);
    
    // Construimos la página.
    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/shop.php';
    include_once '../src/views/layouts/footer.php';
}

/**
 * Muestra la página de un solo producto.
 */
function show_shop_single_page($conn) {
    require_once '../src/controllers/ProductController.php';
    $producto = get_product_by_id($conn, $_GET['id'] ?? 0);
    $page_title = $producto ? $producto['nombre'] : "Producto no encontrado";

    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    if ($producto) {
        include_once '../src/views/pages/shop-single.php';
    } else {
        echo "<p class='container'>Producto no encontrado.</p>";
    }
    include_once '../src/views/layouts/footer.php';
}

/**
 * Muestra la página del perfil del usuario.
 */
function show_profile_page($conn) {
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ' . BASE_URL . 'index.php?route=login');
        exit;
    }
    $page_title = "Mi Perfil";
    require_once '../src/controllers/AuthController.php';
    $user = get_user_details($conn, $_SESSION['id']);
    
    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/profile.php';
    include_once '../src/views/layouts/footer.php';
}

/**
 * Muestra una página simple que no necesita cargar datos desde la BD.
 * @param string $page_name El nombre del archivo de la vista a cargar.
 */
function show_simple_page($page_name) {
    $page_title = $page_name; // Pone la primera letra en mayúscula para el título
    
    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once "../src/views/pages/{$page_name}.php";
    include_once '../src/views/layouts/footer.php';
}