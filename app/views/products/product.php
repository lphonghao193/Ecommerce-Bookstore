<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\ProductsController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . 'public/css/products.css'?>">
<script src= "<?php echo BASE_URL . 'public/js/products.js'?>"></script>
</head>


<body>
    <?php navBar("prod"); ?>
    <main>
    <?php 
        $product = getProduct();
        if (count($product) === 0) {echo "No product found";}
        else {
            $path = BASE_URL . 'public/assets/images/' .$product["IMAGE"];
        }
    ?>

    <section>
            
        <div class="container row">
            <div class="col-4 container-fluid flex-column d-flex justify-content-center">
                <img src="<?=$path?>" alt="" class="img-fluid px-5 pb-5 pt-2 ">
                <button>Add to cart</button>
                <button>Buy now </button>
            </div>
            <div class="col-8 d-flex justify-content-start flex-column">
                <div>
                    <div class="d-flex justify-content-between">
                        <h2><?=$product["PNAME"]?></h2>
                        <h2 style="color: red"><?="$" . $product["PRICE"] . " USD"?></h2>
                    </div>
                    <h6>Category: <?=$product["CNAME"]?></h6>
                    <h6>Author: <?=$product["AUTHOR"]?></h6>
                </div>
                <div>
                    <h2>Description: </h2>
                    <p><?=$product["DESCRIPTION"]?></p>
                </div>
            </div>
        </div>

    </section>

    <section> 
            <h1 class="mt-3">People whose buy <strong><?=$product["PNAME"]?></strong> also buy: </h1>
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
            <h1 class="mt-3">Books in same category:</h1>
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

    </main>
    <?php footer(); ?>
</body>

</html>