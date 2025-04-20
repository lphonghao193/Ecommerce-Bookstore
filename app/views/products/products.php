<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/ProductsController.php' ?>
<?php [$totalPage, $products] = getProductsWithConditions(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup('Products'); ?>
<link rel="stylesheet" href="./public/css/products.css">

</head>
<body>
<?php require_once './app/views/partials/nav.php' ?>
<main>
    <form id="filterForm" action="index.php?page=products" method="GET">
        <div class="sort-filter-bar">
            <button type="button" onclick="showFilter()" class="filter-toggle">
                Filter options
                <i class="material-symbols-outlined px-2">tune</i>
            </button>
            <div class="sort-dropdowns">
                <?php 
                    $sortPrice = $_GET["sort-price"] ?? null; 
                    $sortName = $_GET["sort-name"] ?? null; 
                    ?>
                <select class="sort-select" name="sort-price" onchange="this.form.submit()">
                    <option value="" <?= $sortPrice === null || $sortPrice === "" ? 'selected' : '' ?>>Clear Price Sort</option>
                    <option value="1" <?= $sortPrice == 1 ? 'selected' : '' ?>>Price: Low - High</option>
                    <option value="2" <?= $sortPrice == 2 ? 'selected' : '' ?>>Price: High - Low</option>
                </select>
                <select class="sort-select" name="sort-name" onchange="this.form.submit()">
                    <option value="" <?= $sortName === null || $sortName === "" ? 'selected' : '' ?>>Clear Name Sort</option>
                    <option value="1" <?= $sortName == 1 ? 'selected' : '' ?>>Name: A - Z</option>
                    <option value="2" <?= $sortName == 2 ? 'selected' : '' ?>>Name: Z - A</option>
                </select>
            </div>
            <a href="index.php?page=products" class="clear-filters">Clear filters & sorts</a>
        </div>

        <section id="filter">
            <input type="hidden" name="page" value="products">
            <div>
                <h5>Category:</h5>
                <ul class="category-list">
                    <?php $categories = getCategories(); ?>
                    <?php foreach ($categories as $category) : ?>
                        <li class='category-item'>
                        <input class='hidden-checkbox' type='checkbox' name='filter-category[]' value='<?= $category["CATEGORY_ID"] ?>' id='categ-<?= $category["CATEGORY_ID"] ?>' <?= in_array($category["CATEGORY_ID"], getSelectedCategories()) ? "checked" : "" ?>>
                        <label for='categ-<?= $category["CATEGORY_ID"] ?>' class='category-label'>
                        <?= $category["NAME"] ?>
                        </label>
                        </li>
                    <?php endforeach ?>
                </ul>
                <hr>
                <h5>Price range:</h5>
                <div>
                    From <input class="price-input" type="text" name="filter-price-start" placeholder="0 USD" value=<?= $_GET['filter-price-start'] ?? '' ?>>
                    to <input class="price-input" type="text" name="filter-price-end" placeholder="3000 USD" value=<?= $_GET['filter-price-end'] ?? '' ?>>
                </div>
            </div>
            <div class="filter-btn-container">
                <button type="submit" class="filter-btn">Filter</button>
            </div>
        </section>
    </form>

    <section class="product-list">
        <div class="product-grid">
            <?php if (count($products) == 0)  :?>
                <h3 class='no-product-msg'>No product found!!!</h3>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-col">
                        <div class="product-item" onclick="window.location.href='?page=product&id=<?= $product["PRODUCT_ID"] ?>'">
                            <img src="<?= 'public/assets/images/' . $product["IMAGE"] ?>" alt="Image of $name" class="product-img">
                            <h6 class="fw-bold text-truncate"><?= $product["NAME"] ?></h6>
                            <h6 class="fst-italic"><?= $product["AUTHOR"] ?></h6>
                            <h6>[<?= $product["CNAME"] ?>]</h6>
                            <p class="product-price"><?= $product["PRICE"] ?> USD</p>
                            <button class="add-to-cart" disabled>Add to cart</button>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <br>
        <?php renderPagination($totalPage); ?>
    </section>
</main>
<?php footer(); ?>
</body>
<script src="./public/js/products.js"></script>
</html>
