<!DOCTYPE html>
<html lang="es">

<head>
    <title>Zay Shop - Contacto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    
    <link rel="stylesheet" href="./css/contact.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <?php include './layouts/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet.</p>
        </div>
    </section>

    <div id="mapid" style="width: 100%; height: 300px;"></div>

    <section class="contact-section">
        <div class="container">
            <form class="contact-form" method="post" role="form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputname">Name</label>
                        <input type="text" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="inputemail">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputsubject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="inputmessage">Message</label>
                    <textarea id="message" name="message" placeholder="Message" rows="8"></textarea>
                </div>
                <div class="form-submit-row">
                    <button type="submit" class="btn-primary">Let’s Talk</button>
                </div>
            </form>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h2 class="footer-logo">Zay Shop</h2>
                    <ul>
                        <li><i class="fas fa-map-marker-alt fa-fw"></i> 123 Consectetur at ligula 10660</li>
                        <li><i class="fa fa-phone fa-fw"></i> <a href="tel:010-020-0340">010-020-0340</a></li>
                        <li><i class="fa fa-envelope fa-fw"></i> <a href="mailto:info@company.com">info@company.com</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h2>Products</h2>
                    <ul>
                        <li><a href="#">Luxury</a></li>
                        <li><a href="#">Sport Wear</a></li>
                        <li><a href="#">Men's Shoes</a></li>
                        <li><a href="#">Women's Shoes</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h2>Further Info</h2>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Shop Locations</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-social-icons">
                     <a href="http://fb.com/templatemo"><i class="fab fa-facebook-f"></i></a>
                     <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                     <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                     <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a>
                </div>
                <div class="subscribe-form">
                    <input type="text" placeholder="Email address">
                    <button>Subscribe</button>
                </div>
            </div>
        </div>
        <div class="copyright-bar">
            <div class="container">
                <p>Copyright &copy; 2025 Company Name | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var mymap = L.map('mapid').setView([-23.013104, -43.394365, 13], 13);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Zay Template | Design by <a href="https://templatemo.com/">TemplateMo</a> | Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        L.marker([-23.013104, -43.394365, 13]).addTo(mymap)
            .bindPopup("<b>Zay</b> eCommerce Template<br />Location.").openPopup();

        mymap.scrollWheelZoom.disable();
        mymap.touchZoom.disable();
    </script>

</body>
</html>