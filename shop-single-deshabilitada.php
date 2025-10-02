<!DOCTYPE html>
<html lang="es">

<head>
  <?php include './layouts/head.php'; ?>
</head>

<body>
    <?php include './layouts/header.php'; ?>

    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-layout">
                <div class="product-gallery">
                    <img class="main-product-image" src="assets/img/product_single_10.jpg" alt="Imagen Principal del Producto">
                    <div class="thumbnail-grid">
                        <a href="#"><img src="assets/img/product_single_01.jpg" alt="Miniatura 1"></a>
                        <a href="#"><img src="assets/img/product_single_02.jpg" alt="Miniatura 2"></a>
                        <a href="#"><img src="assets/img/product_single_03.jpg" alt="Miniatura 3"></a>
                    </div>
                </div>

                <div class="product-info">
                    <h1 class="product-title-large">Active Wear</h1>
                    <p class="product-price-large">$25.00</p>
                    <div class="product-rating-large">
                        <i class="fa fa-star star-active"></i>
                        <i class="fa fa-star star-active"></i>
                        <i class="fa fa-star star-active"></i>
                        <i class="fa fa-star star-active"></i>
                        <i class="fa fa-star star-inactive"></i>
                        <span>Rating 4.8 | 36 Comments</span>
                    </div>

                    <h6>Brand: <strong>Easy Wear</strong></h6>
                    <h6>Description:</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. Donec condimentum elementum convallis.</p>

                    <form action="" method="GET">
                        <div class="selectors-row">
                            <div class="size-selector">
                                <label>Size:</label>
                                <span class="size-btn active">S</span>
                                <span class="size-btn">M</span>
                                <span class="size-btn">L</span>
                                <span class="size-btn">XL</span>
                            </div>
                            <div class="quantity-selector">
                                <label>Quantity:</label>
                                <span class="quantity-btn">-</span>
                                <span class="quantity-value">1</span>
                                <span class="quantity-btn">+</span>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" class="btn-primary">Buy</button>
                            <button type="submit" class="btn-secondary">Add To Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="related-products-section">
        <div class="container">
            <h2 class="section-title">Related Products</h2>
            <div id="carousel-related-product">
                <div class="related-item">
                    <div class="shop-product-card">
                        <div class="card-image-container">
                            <img src="assets/img/shop_08.jpg" alt="Product Image">
                            <div class="product-overlay">
                                <a href="#"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" class="product-title">Red Clothing</a>
                            <p class="product-price">$20.00</p>
                        </div>
                    </div>
                </div>
                <div class="related-item">
                    <div class="shop-product-card">
                        <div class="card-image-container">
                            <img src="assets/img/shop_09.jpg" alt="Product Image">
                            <div class="product-overlay">
                                <a href="#"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" class="product-title">White Shirt</a>
                            <p class="product-price">$25.00</p>
                        </div>
                    </div>
                </div>
                 <div class="related-item">
                    <div class="shop-product-card">
                        <div class="card-image-container">
                            <img src="assets/img/shop_10.jpg" alt="Product Image">
                            <div class="product-overlay">
                                <a href="#"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" class="product-title">Oupidatat non</a>
                            <p class="product-price">$45.00</p>
                        </div>
                    </div>
                </div>
                <div class="related-item">
                    <div class="shop-product-card">
                        <div class="card-image-container">
                            <img src="assets/img/shop_11.jpg" alt="Product Image">
                            <div class="product-overlay">
                                <a href="#"><i class="far fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" class="product-title">Black Fashion</a>
                            <p class="product-price">$60.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './layouts/footer.php'; ?>

    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script>
        // Inicialización de Slick Carousel para "Productos Relacionados"
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 3 } },
                { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 2 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } }
            ]
        });
    </script>
</body>
</html>