<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/ProductsController.php' ?>
<?php require_once './app/controllers/Parsedown.php'; ?>
<?php $Parsedown = new Parsedown(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Product "); ?>
    <link rel="stylesheet" href="./public/css/product.css">
    <script src="./public/js/products.js"></script>
</head>
<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main>
        <?php 
            $product = getProduct();
            if (empty($product)) {
                echo "<div class='no-product-message'>No product found</div>";
            } else {
                $imagePath = './public/assets/images/' . $product["IMAGE"];
        ?>
        <section class="product-section">
            <div class="container">
                <div class="row">
                    <!-- Left panel -->
                    <div class="col-lg-4 col-md-5 left-panel">
                        <img src="<?= $imagePath ?>" alt="Product image" class="product-image">
                        <button class="btn btn-action">Add to cart</button>
                        <button class="btn btn-action">Buy now</button>
                    </div>

                    <!-- Right panel -->
                    <div class="col-lg-8 col-md-7 right-panel">
                        <div class="product-header">
                            <h2><?= $product["PNAME"] ?></h2>
                            <h2 class="product-price">$<?= $product["PRICE"] ?> USD</h2>
                        </div>
                        <p class="meta-info">Category: <?= $product["CNAME"] ?></p>
                        <p class="meta-info">Author: <?= $product["AUTHOR"] ?></p>

                        <div class="product-description">
                            <h3>Description:</h3>
                            <p class="meta-info"><?= $Parsedown->text($product["DESCRIPTION"]) ?></p>
                        </div>

                        <div class="related-products">
                            <h3>You may also like:</h3>
                            <div class="row">
                                <?php $featured = getFeatureProducts(); ?>
                                <?php foreach ($featured as $fProduct): ?>
                                    <div class="col-6 col-sm-4 col-md-3 fbook">
                                        <a href="index.php?page=product&id=<?= $fProduct["PRODUCT_ID"] ?>">
                                            <img loading="lazy" src="./public/assets/images/<?= $fProduct['IMAGE'] ?>" alt="<?= $fProduct['NAME'] ?>" class="related-img">
                                        </a>
                                        <h6><?= $fProduct['NAME'] ?></h6>
                                        <h6 class="author-name"><?= $fProduct['AUTHOR'] ?></h6>
                                        <p class="text-danger">$<?= $fProduct['PRICE'] ?> USD</p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </main>
    <?php footer(); ?>
</body>
</html>
