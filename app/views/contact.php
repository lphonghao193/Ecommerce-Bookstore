<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/ProductsController.php'; ?>
<?php $API = 'AIzaSyDNI_ZWPqvdS6r6gPVO50I4TlYkfkZdXh8' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup('Contact'); ?>
    <link rel="stylesheet" href="public/css/contact.css">
</head>

<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main>
        <section>
            <h2>About Us</h2>
        </section>

        <!-- Contact Info Section -->
        <section class="contact-info">
            <div class="info-group">
                <p><strong>Bookstore Name:</strong> Inkspire Bookstore</p>
                <p><strong>Phone:</strong> +84 000 000 000</p>
                <p><strong>Address:</strong> 268 Ly Thuong Kiet, Phuong 14, Quan 10, Thanh pho Ho Chi Minh</p>
                <p><strong>Email:</strong> contact@inkspire.com</p>
                <p><strong>Opening Hours:</strong> Mon - Sat: 9 AM - 8 PM</p>
                <p><strong>Locations:</strong></p>
                <div class="location-map-wrapper">
                    <div class="button-column">
                        <div id="location-buttons" class="location-buttons"></div>
                    </div>
                    <div class="map-column">
                        <div id="map" style="width: 100%; height: 400px; margin-bottom: 30px;"></div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <?php footer(); ?>
</body>

<script src="public/js/contact.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $API ?>&libraries=places&callback=initMap" async></script>
</html>
