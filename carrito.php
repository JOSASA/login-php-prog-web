<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include './layouts/head.php'; ?>
    <title>Tu Carrito de Compras</title>
</head>
<body>
    <?php include './layouts/header.php'; ?>

    <main class="page-content">
        <div class="container">
            <h1 class="page-title">Tu Carrito</h1>

            <?php if (empty($_SESSION['carrito'])): ?>
                <div class="cart-empty">
                    <p>Tu carrito está vacío.</p>
                    <a href="shop.php" class="btn-primary">Seguir comprando</a>
                </div>
            <?php else: ?>
                <div class="cart-layout">
                    <div class="cart-items">
                        <?php
                        $total = 0;
                        foreach ($_SESSION['carrito'] as $id => $producto):
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        ?>
                            <div class="cart-item">
                                <div class="cart-item-img">
                                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                                </div>
                                <div class="cart-item-details">
                                    <h3 class="product-title"><?= htmlspecialchars($producto['nombre']) ?></h3>
                                    <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                                </div>
                                
                                <div class="cart-item-quantity">
                                    <form action="./php/actualizar_carrito.php" method="post" class="quantity-form">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <button type="submit" name="action" value="restar" class="quantity-btn">-</button>
                                        <span class="quantity-value"><?= $producto['cantidad'] ?></span>
                                        <button type="submit" name="action" value="sumar" class="quantity-btn">+</button>
                                    </form>
                                </div>
                                
                                <div class="cart-item-subtotal">
                                    $<?= number_format($subtotal, 2) ?>
                                </div>
                                <div class="cart-item-remove">
                                     <a href="eliminar_del_carrito.php?id=<?= $id ?>" class="btn-remove" title="Eliminar Producto">×</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-summary">
                        <h2>Resumen del Pedido</h2>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>$<?= number_format($total, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span>Gratis</span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>$<?= number_format($total, 2) ?></span>
                        </div>
                        <button class="btn-primary btn-checkout">Proceder al Pago</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include './layouts/footer.php'; ?>
</body>
</html>