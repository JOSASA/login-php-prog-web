<?php
// header.php
// Es crucial iniciar la sesión en cada página que la use

require_once 'php/cookies.php'; // Asegúrate de tener la conexión a la base de datos
?>

<nav class="top-nav">
    </nav>

<header class="main-header">
    <div class="container header-content">
        <a class="logo" href="index.php">eBrainrot</a>
        <ul class="main-nav">
            <li><a class="nav-link" href="index.php">Inicio</a></li>
            <li><a class="nav-link" href="shop.php">Productos</a></li>
            <li><a class="nav-link" href="contact.php">Contacto</a></li>
            <li><a class="nav-link" href="about.php">Acerca de</a></li>
        </ul>
<?php
$items_en_carrito = 0;
if (!empty($_SESSION['carrito'])) {
    // Esto cuenta la cantidad total de productos, no solo los tipos de producto
    $items_en_carrito = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
}
?>
        <div class="header-icons">
            <a class="nav-icon" href="#"><i class="fa fa-fw fa-search"></i></a>
            <a class="nav-icon cart-icon" href="carrito.php">
                <i class="fa fa-fw fa-cart-arrow-down"></i>
                <?php if ($items_en_carrito > 0): ?>
                    <span class="cart-count"><?= $items_en_carrito ?></span>
                <?php endif; ?>
            </a>
            
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a class="nav-icon" href="./perfil.php"><i class="fa fa-fw fa-user"></i></a>
                <div class="user-info">
                    <span>Bienvenido, <?= htmlspecialchars($_SESSION['name']) ?>!</span>
                    <a class="my_button" href="./php/logout.php">Cerrar Sesión</a>
                </div>
            <?php else: ?>
                <a class="nav-icon" href="login.php"><i class="fa fa-fw fa-user"></i> Iniciar Sesión</a>
            <?php endif; ?>

        </div>
    </div>
</header>