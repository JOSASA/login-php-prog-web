<?php
// public/index.php

// Muestra todos los errores de PHP en pantalla para depuración.
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../src/config/dbconnect.php';
require_once '../src/config/config.php';
require_once '../src/controllers/ProductController.php';
require_once '../src/controllers/AuthController.php';
require_once '../src/controllers/CartController.php';

if (!isset($_SESSION['loggedin']) && isset($_COOKIE['remember_me_id'], $_COOKIE['remember_me_token'])) {
    // ... lógica de cookies ...
}

// --- ROUTER PARA ACCIONES (POST) ---
$action = $_POST['action'] ?? null;
if ($action) {
    switch ($action) {
        case 'login':
        case 'register':
        case 'logout':
            
            if (function_exists("handle_{$action}")) call_user_func("handle_{$action}", $conn);
            break;
        
        case 'cart_add':
           
            handle_add_to_cart($conn);
            break;

        // ✅ CORRECCIÓN: Se añade el caso para 'cart_update'.
        case 'cart_update':
            
            handle_update_cart($conn);
            break;
    }
    exit();
}
// =========================================================================
// BLOQUE 4: ROUTER PARA VISTAS (PÁGINAS GET)
// =========================================================================


$route = $_GET['route'] ?? 'home';

// Incluimos el header y el head ANTES de decidir qué página mostrar.
// Esto asegura que estén presentes en todas las páginas.
include_once '../src/views/layouts/head.php';
include_once '../src/views/layouts/header.php';

// El switch ahora solo se enfoca en incluir el contenido principal de cada página.
switch ($route) {
    case 'shop':
        // La lógica para obtener los productos se queda aquí, justo antes de incluir la vista.
        $categoria_filtro = $_GET['categoria'] ?? null;
        $orden_filtro = $_GET['orden'] ?? 'newest';
        $productos = get_all_products($conn, $categoria_filtro, $orden_filtro);
        $categorias = get_all_categories($conn);
        
        include_once '../src/views/pages/shop.php';
        break;

    case 'shop-single':
        $producto = get_product_by_id($conn, $_GET['id'] ?? 0);
        if ($producto) {
            include_once '../src/views/pages/shop-single.php';
        } else {
            echo "<p class='container'>Producto no encontrado.</p>";
        }
        break;

    case 'profile':
        if (!isset($_SESSION['loggedin'])) {
            header('Location: ' . BASE_URL . 'index.php?route=login');
            exit;
        }
        $user = get_user_details($conn, $_SESSION['id']);
        include_once '../src/views/pages/profile.php';
        break;

    // Las páginas que no necesitan cargar datos se incluyen directamente.
    case 'cart':
        include_once '../src/views/pages/carrito.php';
        break;
    case 'cart_remove':
        // Esta ruta no muestra una página, solo ejecuta una acción y redirige.
        handle_remove_from_cart($conn);
        exit();
    case 'login':
        include_once '../src/views/pages/login.php';
        break;
    case 'register':
        include_once '../src/views/pages/register.php';
        break;
    case 'contact':
        include_once '../src/views/pages/contact.php';
        break;
    case 'about':
        include_once '../src/views/pages/about.php';
        break;
    case 'checkout':
        include_once '../src/views/pages/checkout.php';
        break;
    
    case 'home':
    default:
        // Lógica para la página de inicio.
        
        include_once '../src/views/pages/home.php';
        break;
}

// Incluimos el footer al final.
include_once '../src/views/layouts/footer.php';

?>