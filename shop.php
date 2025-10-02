<!DOCTYPE html>
<html lang="es">

<head>
    <?php include './layouts/head.php'; ?>
</head>

<body>
    <?php include './layouts/header.php'; ?>

    <main class="shop-page-content">
        <div class="container">
            <div class="shop-layout">
                <aside class="sidebar">
                    <h2 class="sidebar-title">Categorias</h2>
                    <ul class="category-list">
                        <li class="category-item">
                            <a class="category-link" href="#">COMPONENTES</a>
                            <ul class="subcategory-list">
                                <li><a href="#">INTEL</a></li>
                                <li><a href="#">AMD</a></li>
                            </ul>
                        </li>
                        <li class="category-item">
                            <a class="category-link" href="#">OFERTAS</a>
                            <ul class="subcategory-list">
                                <li><a href="#">GAMING</a></li>
                                <li><a href="#">NORMAL</a></li>
                            </ul>
                        </li>
                        <li class="category-item">
                            <a class="category-link" href="#">PRODUCTOS</a>
                            <ul class="subcategory-list">
                                <li><a href="#">TECLADOS</a></li>
                                <li><a href="#">SWITCHES</a></li>
                                <li><a href="#">MOUSES</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>

                <section class="product-area">
                    <div class="shop-top-bar">
                        <ul class="shop-filter-menu">
                            <li><a class="active" href="#">TODO</a></li>
                            <li><a href="#">PC</a></li>
                            <li><a href="#">LAPTOPS</a></li>
                        </ul>
                        <select class="sort-dropdown">
                            <option>Recomendados</option>
                            <option>A to Z</option>
                            <option>Precio</option>
                        </select>
                    </div>

                    <div class="shop-products-grid">
                        <div class="shop-product-card">
    <div class="card-image-container">
        <img src="assets/img/componentes/RAM_ACER_2x16_DDR5 (1).png" alt="Product Image">
        <div class="product-overlay">
            <a href="shop-single.php?id=1"><i class="far fa-eye"></i></a> <form action="./php/agregar_al_carrito.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="101"> <input type="hidden" name="nombre" value="RAM ACER DDR5">
                <input type="hidden" name="precio" value="250.00">
                <input type="hidden" name="cantidad" value="1"> <input type="hidden" name="imagen" value="assets/img/componentes/RAM_ACER_2x16_DDR5 (1).png">
                <!-- agregaremos el alert al boton de agregar al carrito -->

                <button type="submit" class="cart-button" onclick="alert('Producto agregado al carrito');">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="#" class="product-title">RAM ACER DDR5</a>
        <p class="product-price">$250.00</p>
    </div>
</div>

                        <div class="shop-product-card">
                            <div class="card-image-container">
        <img src="assets/img/componentes/AMD_ASUS_B650M_AII_PRIME.png" alt="Product Image">
        <div class="product-overlay">
            <a href="shop-single.php?id=1"><i class="far fa-eye"></i></a> <form action="./php/agregar_al_carrito.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="102"> <input type="hidden" name="nombre" value="AMD ASUS B650M AII PRIME">
                <input type="hidden" name="precio" value="250.00">
                <input type="hidden" name="cantidad" value="1"> <input type="hidden" name="imagen" value="assets/img/componentes/AMD_ASUS_B650M_AII_PRIME.png">
                <!-- agregaremos el alert al boton de agregar al carrito -->

                <button type="submit" class="cart-button" onclick="alert('Producto agregado al carrito');">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="#" class="product-title">AMD ASUS B650M AII PRIME</a>
        <p class="product-price">$250.00</p>
    </div>
                        </div>

                        <div class="shop-product-card">
                            <div class="card-image-container">
                <img src="assets/img/componentes/Procesador_AMD_Ryzen_5_5600XT.png" alt="Product Image">
        <div class="product-overlay">
            <a href="shop-single.php?id=1"><i class="far fa-eye"></i></a> <form action="./php/agregar_al_carrito.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="103"> <input type="hidden" name="nombre" value="AMD RYZEN 5 5600XT">
                <input type="hidden" name="precio" value="250.00">
                <input type="hidden" name="cantidad" value="1"> <input type="hidden" name="imagen" value="assets/img/componentes/Procesador_AMD_Ryzen_5_5600XT.png">
                <!-- agregaremos el alert al boton de agregar al carrito -->

                <button type="submit" class="cart-button" onclick="alert('Producto agregado al carrito');">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="#" class="product-title">AMD RYZEN 5 5600XT</a>
        <p class="product-price">$250.00</p>
    </div>
                        </div>
                        
                         <div class="shop-product-card">
                            <div class="card-image-container">
                                  <img src="assets/img/componentes/NVIDIA_GEFORCE_RTX_5060TI.png" alt="Product Image">
        <div class="product-overlay">
            <a href="shop-single.php?id=1"><i class="far fa-eye"></i></a> <form action="./php/agregar_al_carrito.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="104"> <input type="hidden" name="nombre" value="NVIDIA GEFORCE RTX 5060Ti">
                <input type="hidden" name="precio" value="250.00">
                <input type="hidden" name="cantidad" value="1"> <input type="hidden" name="imagen" value="assets/img/componentes/NVIDIA_GEFORCE_RTX_5060TI.png">
                <!-- agregaremos el alert al boton de agregar al carrito -->

                <button type="submit" class="cart-button" onclick="alert('Producto agregado al carrito');">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="#" class="product-title">NVIDIA GEFORCE RTX 5060Ti</a>
        <p class="product-price">$250.00</p>
    </div>
                        </div>
                        

                <div class="shop-product-card">
            <div class="card-image-container">
        <img src="assets/img/componentes/Fuente_de_Poder_Cooler_Master G_Gold_750_V2.png" alt="Product Image">
        <div class="product-overlay">
            <a href="shop-single.php?id=1"><i class="far fa-eye"></i></a> <form action="agregar_al_carrito.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="105"> <input type="hidden" name="nombre" value="FUENTE DE PODER COOLER MASTER GOLD 750V2">
                <input type="hidden" name="precio" value="250.00">
                <input type="hidden" name="cantidad" value="1"> <input type="hidden" name="imagen" value="assets/img/componentes/Fuente_de_Poder_Cooler_Master G_Gold_750_V2.png">
                <button type="submit" class="cart-button">
                    <i class="fas fa-cart-plus"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="#" class="product-title">FUENTE DE PODER COOLER MASTER GOLD 750V2</a>
        <p class="product-price">$250.00</p>
    </div>
</div>
                    </div>

                    <div class="pagination-container">
                        <ul class="pagination">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </main>
    
    <section class="brands-section">
        <div class="container">
            <div class="section-header">
                <h1>Marcas</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
            </div>
            <div class="brands-grid">
                <a href="#"><img class="brand-img" src="assets/img/LOGOS/Ryzen.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/LOGOS/INTEL.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/LOGOS/NVIDIA.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/LOGOS/DELL.png" alt="Brand Logo"></a>
            </div>
        </div>
    </section>

    <?php include './layouts/footer.php'; // Asumiendo que has movido el footer a un archivo separado ?>

</body>
</html>