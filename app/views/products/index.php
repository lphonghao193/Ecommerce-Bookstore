<?php session_start() ?> 
<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\ProductsController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . '/public/css/products.css'?>">
<script src= "<?php echo BASE_URL . '/public/js/products.js'?>"></script>
</head>

<body>
    <?php navBar("prod"); ?>
    <main>
        <form id="filterForm" class="container-fluid" action=<?=BASE_URL . 'index.php'?> method="GET">
        
        <button type="button" onclick="showFilter()" class="btn btn-info mb-3 custom-display">
            Filter options
            <i class="bi bi-funnel fs-4 mx-2"></i>
        </button>
        
        <section class="container-fluid" id="filter">
            <input type="hidden" name="page" value="products">
            <div>
                <div>
                    <h5>Category:</h5>
                    <ul class="row mt-2" style="list-style-type: none">
                        <?php 
                        $categories = getCategories();
                        foreach ($categories as $category) {
                            $name = $category["NAME"];
                            $id = $category["ID"];
                            $checked = in_array($id, getSelectedCategories()) ? "checked" : "";

                            echo "<li class='col-lg-3 col-sm-6 col-xs-12 p-3'>";
                            echo "<input class='d-none' type='checkbox' name='filter-category[]' value='$id' id='categ-$id' $checked>";
                            echo "<label for='categ-$id' class='btn btn-outline-danger w-75 text-center' >";
                            echo $name;
                            echo "</label>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                    <hr>
                </div>
                <div>                    
                    <h5>Price range:</h5>
                    <div class="">
                        From
                        <?php $priceRange = getPriceRange() ?>
                        <input class="price-input" type="text" name="filter-price-start" placeholder="0 USD" value=<?= ($priceRange[0] != -1 ? "$priceRange[0]" : "") ?>> to
                        <input class="price-input" type="text" name="filter-price-end" placeholder="3000 USD" value=<?= ($priceRange[1] != -1 ? "$priceRange[1]" : "") ?>>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-danger mx-2"><a class="text-decoration-none" style="color: black" href= <?= BASE_URL . "index.php?page=products" ?>>Clear filters</a></button>
                <button type="submit" class="btn btn-success mx-2">Filter</button>
            </div>
        </section>
        </form>
        
        <section class="" id="sort">
            <div>
                <form id="sortForm" class="container-fluid" action=<?=$_SERVER["REQUEST_URI"]?> method="POST">
                    <h5 >Sort by: </h5>
                    <div class="row container justify-content-left align-items-center">
                        <?php $sortPrice = getSortPrice(); $sortName = getSortName();?>
                        <?php renderRadio("sort-price", "sort-price-asc", 1, $sortPrice, "Price: Low - High"); ?>
                        <?php renderRadio("sort-price", "sort-price-desc", 2, $sortPrice, "Price: High - Low"); ?>
                        <?php renderRadio("sort-name", "sort-name-asc", 1, $sortName, "Name: A - Z"); ?>
                        <?php renderRadio("sort-name", "sort-name-desc", 2, $sortName, "Name: Z - A"); ?>
                        <button class="btn btn-danger col-12 col-md-6 col-lg-2 px-1 custom-display" type="submit" name="clear" value="1">
                            Clear Sort  <i class="bi bi-eyeglasses fs-4 mx-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <section class="product-list justify-content-center align-items-center">
            <div class="row">
                <?php $products = getProductsWithConditions();
                if (count($products) == 0) {
                    echo "<h3 class=\"text-center d-flex flex-column align-items-center p-5\" style=\"color:red\">No product found!!!</h3>";
                } else {
                    for ($i = 0; $i < count($products); $i++) {
                        $id = $products[$i]["ID"];
                        $name = $products[$i]["NAME"];
                        $author = $products[$i]["AUTHOR"];
                        $price = $products[$i]["PRICE"];
                        $categ = $products[$i]["CNAME"];
                        $path = BASE_URL . 'public/assets/images/' . $products[$i]["IMAGE"];
                        $href = BASE_URL . 'index.php?page=product&id=' . $id;
                        echo <<<_END
                        <div class="col-lg-3 col-sm-6 col-xs-12 text-center d-flex flex-column align-items-center p-4">
                            <div class="product-item px-5 py-2">
                                <a href="$href">
                                    <img src="$path" alt="Image of $name" class="img-fluid" style="height : 6cm">
                                    <br><br>    
                                    <h6 class="fw-bold">{$name}</h6>
                                    <h6 class="fst-italic">{$author}</h6>
                                    <h6 class="">[{$categ}]</h6>
                                    <p class="text-danger fst-italic">\${$price} USD</p>
                                </a>
                                <button onclick="" class="add-to-cart"> Add to cart </button>
                            </div>    
                        </div>
                    _END;
                    }
                }
                ?>
            </div>
            <br>
            <div class="text-center">
                <?php $queryString = $_GET;
                unset($queryString['page_id']);
                $queryString = http_build_query($queryString);
                $page = getPageNumber();
                $totalPages = getTotalPages();?>
                <?= "<button class=\"d-inline pagination-btn\" onclick=\"location.href='?page_id=" . ($page - 1) . "&$queryString'\" " . ($page == 1 ? "disabled" : "") . ">Previous</button>"; ?>
                <?php
                if ($totalPages <= 5) {
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $activeClass = ($i == $page) ? "active fw-bold text-decoration-underline" : "";
                        echo "<button class='d-inline $activeClass pagination-btn' onclick=\"location.href='?page_id=$i&$queryString'\">$i</button>";
                    }
                } else {
                    if ($page > 2) echo "<button class=\"d-inline pagination-btn\" onclick=\"location.href='?page_id=1&$queryString'\">1 </button>";
                    if ($page > 1) echo "<button class='d-inline pagination-btn' onclick=\"location.href='?page_id=" . ($page - 1) . "&$queryString'\">" . ($page - 1) . "</button>";
                    echo "<button class='d-inline active fw-bold text-decoration-underline pagination-btn' onclick=\"location.href='?page_id=$page&$queryString'\">$page</button>";
                    if ($page < $totalPages) echo "<button class='d-inline pagination-btn' onclick=\"location.href='?page_id=" . ($page + 1) . "&$queryString'\">" . ($page + 1) . "</button>";
                    if ($page < $totalPages - 1) echo "<button class=\"d-inline pagination-btn\" onclick=\"location.href='?page_id=$totalPages&$queryString'\"> $totalPages</button>";
                }
                ?>
                <?= "<button class=\"d-inline pagination-btn\" onclick=\"location.href='?page_id=" . ($page + 1) . "&$queryString'\" " . ($page == $totalPages ? "disabled" : "") . ">Next</button>"; ?>
            </div>
        </section>
    



    </main>
    <?php footer(); ?>
</body>

</html>