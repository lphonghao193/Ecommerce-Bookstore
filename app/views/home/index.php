<?php session_start(); ?>
<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\HomeController.php' ?>
<?php if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];?>
<?php if (!isset($_SESSION['user'])) $_SESSION['user'] = [];?>
<?php if (!isset($_SESSION['cart'])) $_SESSION['logIn'] = false;?>
<!DOCTYPE html> 
<html lang="en"> 
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . '/public/css/home.css'?>">
<script src= "<?php echo BASE_URL . '/public/js/home.js'?>"></script>
</head>

<body>
    <?php navBar("home"); ?>
    <main> 

        <section class="carousel slide my-3">
            <div class="carousel-inner" id="carouselExampleControls">
                <button class="carousel-control-prev" onclick="prevSlide()">
                    <i class="bi bi-arrow-left-circle fs-1"></i>
                </button>

                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <img class="w-75" src="<?php echo BASE_URL . '/public/assets/images/slide1.jpg'?>" alt="First slide">
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <img class="w-75" src="<?php echo BASE_URL . '/public/assets/images/slide2.jpg'?>" alt="Second slide">
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <img class="w-75" src="<?php echo BASE_URL . '/public/assets/images/slide3.jpg'?>" alt="Third slide">
                    </div>
                </div>
                
                <button class="carousel-control-next" onclick="nextSlide()">
                    <i class="bi bi-arrow-right-circle fs-1"></i>
                </button>
            </div>
        </section>

        
        <section> 
            <h1 class="mt-3 custom-display">Feature books</h1>
            <div class="row mt-5">
                <?php $products = getFeatureProducts(); ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-sm-3 text-center d-flex flex-column align-items-center">
                        <a href="<?= BASE_URL . 'index.php?page=product&id=' . $product["ID"] ?>">
                            <img loading="lazy" src="<?= BASE_URL ?>public/assets/images/<?= $product['IMAGE'] ?>" 
                                alt="Image of <?= $product['NAME'] ?>" 
                                class="img-fluid" 
                                style="height: 6cm">
                        </a>
                        <br>
                        <h6 class="fw-bold"><?= $product['NAME'] ?></h6>
                        <h6 class="fst-italic"><?= $product['AUTHOR'] ?></h6>
                        <p class="text-danger fst-italic">$<?= $product['PRICE'] ?> USD</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h1 class="mt-3 custom-display">Categories</h1>
            <div class="row">
                <?php $categories = getCategories();?>
                <?php foreach ($categories as $category): ?>
                    <div class="col-6 col-sm-3 text-center d-flex flex-column align-items-center">
                        <a href="<?= BASE_URL . 'index.php?page=products&filter-category[]=' . $category['ID'] ?>" style="color: black; width = 3cm; text-decoration: none; padding: 20px">
                            <div>
                                <i class="<?= $category['ICON'] ?>" style="font-size: 30pt"></i>
                            </div>    
                            <h6 class="fw-bold"><?= $category['NAME'] ?></h6>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="quote-section">
            <h1 class = "mt-3 custom-display">Quote of the Day</h1>
            <blockquote class="blockquote p-3">
                <p class="mb-3">"The only way to do great work is to love what you do."</p>
                <footer class="blockquote-footer">Steve Jobs</footer>
            </blockquote>
        </section>

    </main> 
    <?php footer(); ?>
</body> 
</html>