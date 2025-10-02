<!DOCTYPE html>
<html lang="es">

<?php include './layouts/head.php'; ?>

<body>
    
<?php include './layouts/header.php'; ?>

    <section class="hero-banner">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title"><b>eBrainrot</b> eCommerce</h1>
                    <h2 class="hero-subtitle">Tu tienda confiable</h2>
                    <p>
                        eBrainrot es una tienda en linea dirigida hacia la tecnologia Inspirada en <a href="https://ddtech.mx/" target="_blank">DDTECH</a> website. 
                        Credito de las imagenes a <a href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                        <a href="https://unsplash.com/" target="_blank">Unsplash</a> y
                        <a href="https://icons8.com/" target="_blank">Icons 8</a>.
                    </p>
                </div>
                <div class="hero-image">
                    <img src="./assets/img/setup.jpg" alt="Banner Image">
                </div>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h1>Categorias mas relevantes</h1>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="categories-grid">
                <div class="category-item">
                    <a href="#"><img src="./assets/img/componente.jpg" class="category-img"></a>
                    <h5 class="category-title">Componentes</h5>
                    <p><a class="btn-primary">Comprar</a></p>
                </div>
                <div class="category-item">
                    <a href="#"><img src="./assets/img/accesorios.jpg" class="category-img"></a>
                    <h5 class="category-title">Accesorios</h5>
                    <p><a class="btn-primary">Comprar</a></p>
                </div>
                <div class="category-item">
                    <a href="#"><img src="./assets/img/monitor.jpg" class="category-img"></a>
                    <h5 class="category-title">Monitores</h5>
                    <p><a class="btn-primary">Comprar</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h1>Featured Product</h1>
                <p>Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
            <div class="products-grid">
                <div class="product-card">
                    <a href="shop-single.php"><img src="./assets/img/feature_prod_01.jpg" alt="Gym Weight"></a>
                    <div class="card-body">
                        <div class="card-top">
                            <ul class="product-rating">
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-inactive"></i></li>
                                <li><i class="fa fa-star star-inactive"></i></li>
                            </ul>
                            <span class="product-price">$240.00</span>
                        </div>
                        <a href="shop-single.php" class="product-title">Gym Weight</a>
                        <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.</p>
                        <p class="product-reviews">Reviews (24)</p>
                    </div>
                </div>
                <div class="product-card">
                    <a href="shop-single.php"><img src="./assets/img/feature_prod_02.jpg" alt="Cloud Nike Shoes"></a>
                    <div class="card-body">
                        <div class="card-top">
                           <ul class="product-rating">
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-inactive"></i></li>
                                <li><i class="fa fa-star star-inactive"></i></li>
                            </ul>
                            <span class="product-price">$480.00</span>
                        </div>
                        <a href="shop-single.php" class="product-title">Cloud Nike Shoes</a>
                        <p class="product-description">Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.</p>
                        <p class="product-reviews">Reviews (48)</p>
                    </div>
                </div>
                <div class="product-card">
                    <a href="shop-single.php"><img src="./assets/img/feature_prod_03.jpg" alt="Summer Addides Shoes"></a>
                    <div class="card-body">
                        <div class="card-top">
                           <ul class="product-rating">
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                                <li><i class="fa fa-star star-active"></i></li>
                            </ul>
                            <span class="product-price">$360.00</span>
                        </div>
                        <a href="shop-single.php" class="product-title">Summer Addides Shoes</a>
                        <p class="product-description">Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque.</p>
                        <p class="product-reviews">Reviews (74)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include './layouts/footer.php'; ?>

</body>
</html>