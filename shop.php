<?php
session_start();


// 1. CONEXIÓN Y CONSULTA A LA BASE DE DATOS
// ===============================================
require './php/dbconnect.php'; // Incluimos tu archivo de conexión

// Preparamos la consulta para obtener todos los productos
// Los ordenamos por ID de forma descendente para mostrar los más nuevos primero
$sql = "SELECT id, nombre, descripcion, precio, stock, imagen FROM productos ORDER BY id DESC";

// Ejecutamos la consulta
$resultado = $conn->query($sql);
// ===============================================
?>

<!DOCTYPE html>
<html lang="es">

<?php include './layouts/head.php'; ?>

<body>
    <?php include './layouts/header.php'; ?>

    <main class="shop-page-content">
        <div class="container">
            <div class="shop-layout">
                <aside class="sidebar">
                    <h2 class="sidebar-title">Categorias</h2>
                    <ul class="category-list">
                        </ul>
                </aside>

                <section class="product-area">
                    <div class="shop-top-bar">
                        <ul class="shop-filter-menu">
                            </ul>
                        <select class="sort-dropdown">
                            </select>
                    </div>

                    <div class="shop-products-grid">
                        <?php
                        // 2. BUCLE PARA MOSTRAR LOS PRODUCTOS
                        // ===============================================
                        // Verificamos si la consulta devolvió resultados
                        if ($resultado->num_rows > 0) {
                            // Iteramos sobre cada fila (producto)
                            while ($producto = $resultado->fetch_assoc()) {
                        ?>
                                <div class="shop-product-card">
                                    <div class="card-image-container">
                                        <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                                        <div class="product-overlay">
                                            <a href="shop-single.php?id=<?= $producto['id'] ?>"><i class="far fa-eye"></i></a>
                                            
                                            <form action="./php/agregar_al_carrito.php" method="post">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
    <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
    <input type="hidden" name="cantidad" value="1">
    <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">

    <button type="submit" class="cart-button">
        <i class="fas fa-cart-plus"></i>
    </button>
</form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="shop-single.php?id=<?= $producto['id'] ?>" class="product-title"><?= htmlspecialchars($producto['nombre']) ?></a>
                                        <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                                    </div>
                                </div>
                                <?php
                            } // Fin del bucle while
                        } else {
                            // Si no hay productos, mostramos un mensaje
                            echo "<p>No hay productos disponibles en este momento.</p>";
                        }
                        // ===============================================
                        
                        // Cerramos la conexión a la base de datos
                        $conn->close();
                        ?>
                    </div>

                    <div class="pagination-container">
                        <ul class="pagination">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </main>
    
    <section class="brands-section">
        <div class="container">
            </div>
    </section>

    <?php include './layouts/footer.php'; ?>
</body>
</html>