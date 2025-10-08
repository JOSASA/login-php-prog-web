<?php
// src/views/pages/shop.php
// Esta vista espera que el router le pase las variables '$productos' y '$categorias'.
$categoria_actual = $_GET['categoria'] ?? '';
$orden_actual = $_GET['orden'] ?? 'newest';
?>
<link rel="stylesheet" href="<?= BASE_URL ?>css/shop.css">
<main class="shop-page-content">
    <div class="container">
        <div class="shop-layout">

            <aside class="sidebar">
                <h2 class="sidebar-title">Categorías</h2>
                <ul class="category-list">
                    <li>
                        <a href="<?= BASE_URL ?>index.php?route=shop" class="<?= empty($categoria_actual) ? 'active' : '' ?>">Todas</a>
                    </li>
                    <?php if (isset($categorias) && !empty($categorias)): ?>
                        <?php foreach ($categorias as $cat): ?>
                            <li>
                                <a href="<?= BASE_URL ?>index.php?route=shop&categoria=<?= urlencode($cat) ?>" class="<?= ($categoria_actual === $cat) ? 'active' : '' ?>">
                                    <?= htmlspecialchars($cat) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </aside>
            <section class="product-area">
                <div class="shop-top-bar">
                    <form action="<?= BASE_URL ?>index.php" method="get" class="sort-form">
                        <input type="hidden" name="route" value="shop">
                        <?php if ($categoria_actual): ?>
                            <input type="hidden" name="categoria" value="<?= htmlspecialchars($categoria_actual) ?>">
                        <?php endif; ?>
                        
                        <select name="orden" class="sort-dropdown" onchange="this.form.submit()">
                            <option value="newest" <?= $orden_actual === 'newest' ? 'selected' : '' ?>>Más nuevos</option>
                            <option value="price_asc" <?= $orden_actual === 'price_asc' ? 'selected' : '' ?>>Precio: Menor a Mayor</option>
                            <option value="price_desc" <?= $orden_actual === 'price_desc' ? 'selected' : '' ?>>Precio: Mayor a Menor</option>
                            <option value="name_asc" <?= $orden_actual === 'name_asc' ? 'selected' : '' ?>>Nombre: A-Z</option>
                        </select>
                    </form>
                </div>

                <div class="shop-products-grid">
                    <?php if (isset($productos) && $productos->num_rows > 0): ?>
                        <?php while ($producto = $productos->fetch_assoc()): ?>
                            <div class="shop-product-card">
                                <div class="card-image-container">
                                    <img src="<?= BASE_URL. htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                                </div>
                                <div class="card-body">
                                    <a href="<?= BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" class="product-title"><?= htmlspecialchars($producto['nombre']) ?></a>
                                    <div class="card-bottom">
                                        <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                                        <div class="card-action-buttons">
                                            <a href="<?= BASE_URL ?>index.php?route=shop-single&id=<?= $producto['id'] ?>" class="btn-view-details-icon" title="Ver Detalles">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <form action="<?= BASE_URL ?>index.php" method="post">
                                                <input type="hidden" name="action" value="cart_add">
                                                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                                                <input type="hidden" name="cantidad" value="1">
                                                <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                                                <button type="submit" class="btn-add-cart-alt" title="Agregar al Carrito">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No se encontraron productos que coincidan con tu búsqueda.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</main>