<!DOCTYPE html>
<html lang="es">

<head>
    <title>Zay Shop - Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="./css/shop.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <?php include './layouts/header.php'; ?>

    <main class="shop-page-content">
        <div class="container">
            <div class="shop-layout">
                <aside class="sidebar">
                    <h2 class="sidebar-title">Categories</h2>
                    <ul class="category-list">
                        <li class="category-item">
                            <a class="category-link" href="#">Gender</a>
                            <ul class="subcategory-list">
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Women</a></li>
                            </ul>
                        </li>
                        <li class="category-item">
                            <a class="category-link" href="#">Sale</a>
                            <ul class="subcategory-list">
                                <li><a href="#">Sport</a></li>
                                <li><a href="#">Luxury</a></li>
                            </ul>
                        </li>
                        <li class="category-item">
                            <a class="category-link" href="#">Product</a>
                            <ul class="subcategory-list">
                                <li><a href="#">Bag</a></li>
                                <li><a href="#">Sweather</a></li>
                                <li><a href="#">Sunglass</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>

                <section class="product-area">
                    <div class="shop-top-bar">
                        <ul class="shop-filter-menu">
                            <li><a class="active" href="#">All</a></li>
                            <li><a href="#">Men's</a></li>
                            <li><a href="#">Women's</a></li>
                        </ul>
                        <select class="sort-dropdown">
                            <option>Featured</option>
                            <option>A to Z</option>
                            <option>Item</option>
                        </select>
                    </div>

                    <div class="shop-products-grid">
                        <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_01.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
                                <p class="product-price">$250.00</p>
                            </div>
                        </div>

                        <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_02.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
                                <p class="product-price">$250.00</p>
                            </div>
                        </div>

                        <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_03.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
                                <p class="product-price">$250.00</p>
                            </div>
                        </div>
                        
                         <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_04.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
                                <p class="product-price">$250.00</p>
                            </div>
                        </div>
                        
                         <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_05.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
                                <p class="product-price">$250.00</p>
                            </div>
                        </div>

                         <div class="shop-product-card">
                            <div class="card-image-container">
                                <img src="assets/img/shop_06.jpg" alt="Product Image">
                                <div class="product-overlay">
                                    <a href="#"><i class="far fa-heart"></i></a>
                                    <a href="#"><i class="far fa-eye"></i></a>
                                    <a href="#"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="product-title">Oupidatat non</a>
                                <p class="product-sizes">M/L/X/XL</p>
                                <div class="product-rating">
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-active"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                    <i class="fa fa-star star-inactive"></i>
                                </div>
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
                <h1>Our Brands</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
            </div>
            <div class="brands-grid">
                <a href="#"><img class="brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                <a href="#"><img class="brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
            </div>
        </div>
    </section>

    <?php include './layouts/footer.php'; // Asumiendo que has movido el footer a un archivo separado ?>

</body>
</html>