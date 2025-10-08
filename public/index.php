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
            handle_login($conn);
            break;
        case 'register':
            handle_register($conn);
            break;
        case 'logout':            
            handle_logout();
            break;        
        case 'cart_add':        
            handle_add_to_cart($conn);
            break;
        case 'cart_update':
            handle_update_cart($conn);
            break;
    }
    exit();
}
// =========================================================================
// BLOQUE 4: ROUTER PARA VISTAS (PÁGINAS GET)
// =========================================================================


require_once '../src/controllers/PageController.php';

$route = $_GET['route'] ?? 'home';

// El switch ahora es súper simple: solo llama a la función correcta.
switch ($route) {
    case 'shop':
        show_shop_page($conn);
        break;
    case 'shop-single':
        show_shop_single_page($conn);
        break;
    case 'profile':
        show_profile_page($conn);
        break;
    
    // Para las páginas simples, llamamos a la función genérica
    case 'cart':
        show_simple_page('carrito');
        break;
    case 'login':
        show_simple_page($route);
    case 'register':
        show_simple_page($route);
    case 'contact':
    case 'about':
    case 'checkout':
        show_simple_page($route);
        break;
    
    case 'home':
    default:
        show_home_page($conn);
        break;
}

?>