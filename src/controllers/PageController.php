<?php


//mostrar dasboard del admin
function show_dashboard_page($conn) {
    // 1. ¡SEGURIDAD PRIMERO!
    check_admin_auth(); 

    // 2. Lógica e Inclusiones
    require_once '../src/controllers/dasboardController.php'; // ¡Corrige el nombre si lo cambiaste!

    // 3. Preparación de Datos
    $stats = get_dashboard_stats($conn);
    $page_title = 'Dashboard'; 

    // 4. Renderizado de la Vista (usando las nuevas plantillas admin)
    include_once '../src/views/layouts/admin_head.php';
    include_once '../src/views/layouts/admin_sidebar.php';
    include_once '../src/views/pages/admin/dashboard_view.php'; // La vista específica
    include_once '../src/views/layouts/admin_footer.php';

    $conn->close();
}
function show_admin_products_page($conn) {
    // 1. ¡SEGURIDAD PRIMERO!
    check_admin_auth();

    // 2. Lógica e Inclusiones
    // (ProductController ya está cargado en index.php, pero es bueno ser explícito)
    require_once '../src/controllers/ProductController.php'; 

    // 3. Preparación de Datos
    // Usamos la función que ya tenías, sin filtros
    $products = get_all_products($conn, null, 'newest'); 
    $page_title = 'Gestionar Productos';

    // 4. Renderizado de la Vista
    include_once '../src/views/layouts/admin_head.php';
    include_once '../src/views/layouts/admin_sidebar.php';
    include_once '../src/views/pages/admin/manage_products_view.php'; // La vista de productos
    include_once '../src/views/layouts/admin_footer.php';

    $conn->close();
}
function show_admin_users_page($conn) {
    // 1. ¡SEGURIDAD PRIMERO!
    check_admin_auth();

    // 2. Lógica e Inclusiones
    require_once '../src/controllers/UserController.php'; 

    // 3. Preparación de Datos
    $users = get_all_users($conn); 
    $page_title = 'Gestionar Usuarios';

    // 4. Renderizado de la Vista
    include_once '../src/views/layouts/admin_head.php';
    include_once '../src/views/layouts/admin_sidebar.php';
    include_once '../src/views/pages/admin/manage_users_view.php'; // La vista de usuarios
    include_once '../src/views/layouts/admin_footer.php';

    $conn->close();
}
function show_admin_orders_page($conn) {
    // 1. ¡SEGURIDAD PRIMERO!
    check_admin_auth();

    // 2. Lógica e Inclusiones
    require_once '../src/controllers/UserController.php'; 
    
    // 3. Preparación de Datos
    $orders = get_all_orders_admin($conn); 
    $page_title = 'Gestionar Pedidos';

    // 4. Renderizado de la Vista
    include_once '../src/views/layouts/admin_head.php';
    include_once '../src/views/layouts/admin_sidebar.php';
    include_once '../src/views/pages/admin/manage_orders_view.php'; // La vista de pedidos
    include_once '../src/views/layouts/admin_footer.php';

    $conn->close();
}
function show_home_page($conn)
{
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
function show_shop_page($conn)
{
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
function show_shop_single_page($conn)
{
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
function show_profile_page($conn)
{
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        header('Location: ' . BASE_URL . 'index.php?route=login');
        exit;
    }

    require_once '../src/controllers/AuthController.php';
    $user = get_user_details($conn, $_SESSION['id']);
    $page_title = "Mi Perfil";

    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/perfil.php';
    include_once '../src/views/layouts/footer.php';
}


/**
 * Muestra una página simple que no necesita cargar datos desde la BD.
 * @param string $page_name El nombre del archivo de la vista a cargar.
 */
function show_simple_page($page_name)
{
    $page_title = $page_name; // Pone la primera letra en mayúscula para el título
    //vamos a descartar la pagina register y login de este metodo
    if ($page_name === 'login' || $page_name === 'register') {
        include_once '../src/views/layouts/head.php';
        include_once "../src/views/pages/{$page_name}.php";
    } else {
        include_once '../src/views/layouts/head.php';
        include_once '../src/views/layouts/header.php';
        include_once "../src/views/pages/{$page_name}.php";
        include_once '../src/views/layouts/footer.php';
    }

}
function show_checkout_page($data = []) {
    extract($data); // $usuario, $direccion, $subtotal, $costo_envio, $total
    $page_title = "Checkout";

    include_once '../src/views/layouts/head.php';
    include_once '../src/views/layouts/header.php';
    include_once '../src/views/pages/checkout.php';
    include_once '../src/views/layouts/footer.php';
}
