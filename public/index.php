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
require_once '../src/controllers/OrderController.php';
require_once '../src/controllers/PageController.php';

// ...

if (!isset($_SESSION['loggedin']) && !isset($_SESSION['is_admin']) && isset($_COOKIE['remember_me_id'], $_COOKIE['remember_me_token'])) {
    $user_id = $_COOKIE['remember_me_id'];
    $token = $_COOKIE['remember_me_token'];

    // MODIFICACIÓN: Añade 'rol' al SELECT
    $stmt = $conn->prepare('SELECT id, username, nombre, rol, remember_me_token, token_expiry FROM usuarios WHERE id = ?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $user = $resultado->fetch_assoc();
        
        if (hash_equals($user['remember_me_token'], $token) && strtotime($user['token_expiry']) > time()) {
            
            session_regenerate_id(true);
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = !empty($user['nombre']) ? $user['nombre'] : $user['username'];

            // MODIFICACIÓN: Revisa el rol para crear la sesión correcta
            if ($user['rol'] === 'admin') {
                $_SESSION['is_admin'] = true;
            } else {
                $_SESSION['loggedin'] = true;
                // Sincronizamos el carrito solo para usuarios normales
                sync_cart_from_db_on_login($conn, $user['id']);
            }
        }
    }
    $stmt->close();
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
        case 'place_order':
            handle_place_order($conn);
            break;
        case 'update_profile':
            handle_update_user($conn);
            break;
        case 'delete_user':
            handle_delete_user($conn);
            break;
        case 'create_product':
            handle_create_product($conn);
            break;
    }
    exit();
}

//  ROUTER PARA VISTAS (PÁGINAS GET)





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
        break;
    case 'register':
        show_simple_page($route);
        break;
    case 'dashboard':
        show_dashboard_page($conn);
        break;
    case 'admin_products':
        show_admin_products_page($conn);
        break;
    case 'admin_users':
        show_admin_users_page($conn);
        break;
    case 'admin_orders':
        show_admin_orders_page($conn);
        break;
    case 'admin_create_product':
        show_admin_create_product_page($conn);
        break;
    case 'contact':
    case 'about':
    

    case 'checkout':
    // 1. Verificaciones de seguridad (solo usuarios logueados con carrito no vacío).
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        header('Location: ' . BASE_URL . 'index.php?route=login');
        exit();
    }
    if (empty($_SESSION['carrito'])) {
        header('Location: ' . BASE_URL . 'index.php?route=shop');
        exit();
    }

    $page_title = "Finalizar Compra";

    // Obtener datos del usuario
    $usuario = get_user_details($conn, $_SESSION['id']);

    // Obtener última dirección del usuario desde pedidos
    $stmt = $conn->prepare("
        SELECT calle, numero, colonia, ciudad, estado, codigo_postal, referencias
        FROM pedidos
        WHERE usuario_id = ?
        ORDER BY fecha_pedido DESC
        LIMIT 1
    ");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $direccion = $result->fetch_assoc() ?? [];
    $stmt->close();

    // Calcular totales
    $subtotal = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal += $item['precio'] * $item['cantidad'];
    }
    $costo_envio = 150.00;
    $total = $subtotal + $costo_envio;

    // Llamamos a la vista, pasando **todos los datos listos**
    show_checkout_page([
        'usuario' => $usuario,
        'direccion' => $direccion,
        'subtotal' => $subtotal,
        'costo_envio' => $costo_envio,
        'total' => $total
    ]);
    break;
    case 'home':
    default:
        show_home_page($conn);
        break;
}

?>