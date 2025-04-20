<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/HomeController.php' ?>
<!DOCTYPE html> 
<html lang="en"> 
<head>
<?php pageSetup("Homepage "); ?>
<link rel="stylesheet" href= "<?php echo './public/css/home.css'?>">
<script src= "<?php echo './public/js/home.js'?>"></script>
</head>

<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main> 

        <section class="carousel slide">
            <div class="carousel-inner" id="carouselExampleControls">
                <button class="carousel-control-prev" onclick="prevSlide()">
                    <i class="bi bi-arrow-left-circle fs-1"></i>
                </button>

                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <img class="w-100" src="./public/assets/images/slide1.jpg" alt="First slide">
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <img class="w-100" src="./public/assets/images/slide2.jpg" alt="Second slide">
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <img class="w-100" src="./public/assets/images/slide3.jpg" alt="Third slide">
                    </div>
                </div>
                
                <button class="carousel-control-next" onclick="nextSlide()">
                    <i class="bi bi-arrow-right-circle fs-1"></i>
                </button>
            </div>
        </section>


        <section> 
            <h1>Our Services</h1>
            <div class="services">
                <div class="service" onclick="window.location.href='?page=products'">
                    <h2>Books</h2>
                    <div class="service-info">
                        <img src="./public/assets/images/books.jpg" alt="Image for books">
                        <p>
                        Explore a wide range of books across genres — from timeless classics and bestsellers to new releases and hidden gems. Whether you're into fiction, non-fiction, or children's literature, our curated collection offers something for every kind of reader.
                        </p>
                    </div>
                </div>
                <div class="service" onclick="window.location.href='?page=categories'">
                    <h2>Categories</h2>
                    <div class="service-info">
                        <img src="./public/assets/images/categories.jpg" alt="Image for book genres">
                        <p>
                            Easily browse by genre, author, or age group to find your next great read. Our categories help you discover books tailored to your interests — whether you're craving mystery, diving into self-help, or picking the perfect bedtime story.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <section> 
            <h1>Feature Books</h1>
            <div class="fbooks">
                <?php $products = getFeatureProducts(); ?>
                <?php foreach ($products as $product): ?>
                    <div class="fbook">
                        <a href="index.php?page=product&id=<?= $product["PRODUCT_ID"] ?>">
                            <img loading="lazy" src="./public/assets/images/<?= $product['IMAGE'] ?>" 
                                alt="Image of <?= $product['NAME'] ?>" 
                                class="img-fluid">
                        </a>
                        <br>
                        <h6 class="fw-bold"><?= $product['NAME'] ?></h6>
                        <h6 class="fst-italic"><?= $product['AUTHOR'] ?></h6>
                        <p class="text-danger fst-italic">$<?= $product['PRICE'] ?> USD</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main> 
    <?php footer(); ?>
</body> 
</html>