<?php 
require_once APP_PATH . "\app\models\ProductsModel.php";
require_once APP_PATH . "\app\models\CategoriesModel.php";
$productsPerPage = 12;
$productsCount = 0;


if (isset($_POST['clear']) && $_POST['clear'] == 1) {
    unset($_POST["sort-price"]) ;
    unset($_POST["sort-name"]);
}

function getCategories() {
    $categoriesModel = new Categories(DATABASE);
    $categories = $categoriesModel->getCategories();
    return $categories;
}

function renderRadio($name, $id, $value, $checkedValue, $label) {
    $checked = ($checkedValue == $value) ? "checked" : "";
    $bgColor = "background-color:" . (($checkedValue == $value) ? "#A27B5C;" : "white;");
    $icon = "";
    if ($value == 2) {
        $icon = "<i class='bi bi-sort-down fs-4'></i>";
    } elseif ($value == 1) {
        $icon = "<i class='bi bi-sort-up fs-4'></i>";
    };
    echo "<div class='col-12 col-md-6 col-lg-2 px-1 custom-display'>";
    echo "<input class='d-none' type='radio' name='$name' id='$id' value='$value' onchange='this.form.submit()' $checked>";
    echo "<label class='btn sort-btn w-100 d-flex align-items-center justify-content-center gap-1' for='$id' style='cursor: pointer; $bgColor'>";
    echo "$label $icon";
    echo "</label>";
    echo "</div>";
}


function getSortPrice() {
    $sortPrice = isset($_POST['sort-price']) ? $_POST['sort-price'] : -1;
    return $sortPrice;
}

function getSortName() {
    $sortName = isset($_POST['sort-name']) ? $_POST['sort-name'] : -1;
    return $sortName;
}

function getSelectedCategories() {
    $selectedCategories = !empty($_GET['filter-category'])? $_GET['filter-category'] : [];
    return $selectedCategories;
}

function getPriceRange() {
    $range = Array(-1,-1);
    if (!empty($_GET['filter-price-start']) && is_numeric($_GET['filter-price-start'])) {
        $range[0] = $_GET['filter-price-start'];
    }
    if (!empty($_GET['filter-price-end']) && is_numeric($_GET['filter-price-end'])) {
        $range[1] = $_GET['filter-price-end'];
    }
    return $range;
}

function getPageNumber() {
    $page = isset($_GET['page_id']) && is_numeric($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
    return $page;
}

function getProductsWithConditions() {
    $productsModel = new Products(DATABASE);

    $whereClauses = [];
    if (!empty(getSelectedCategories())) {$whereClauses[] = "P.CATEGORY_ID IN (" . implode(", ", getSelectedCategories()) . ")";}

    $priceRange = getPriceRange();
    if ($priceRange[0] != -1) $whereClauses[] = "P.PRICE >= " . $priceRange[0];
    if ($priceRange[1] != -1) $whereClauses[] = "P.PRICE <= " . $priceRange[1];

    $orderBy = Array();
    if (getSortPrice() == 1) {$orderBy[] = "P.PRICE ASC";}
    elseif (getSortPrice() == 2) {$orderBy[] = "P.PRICE DESC";}
    if (getSortName() == 1) {$orderBy[] = "P.NAME ASC";}
    else if (getSortName() == 2) {$orderBy[] = "P.NAME DESC";}


    global $productsPerPage;
    $page = getPageNumber();
    $offset = ($page - 1) * $productsPerPage;

    
    global $productsCount;
    $products = $productsModel->getProductsWithConditions($whereClauses, $orderBy, $productsPerPage, $offset);
    $productsCount = count($productsModel->getProductsWithConditions($whereClauses, $orderBy));
    return $products;
}

function getTotalPages() {
    global $productsPerPage;
    global $productsCount;
    return ceil($productsCount/$productsPerPage);
}

function getProduct() {
    $id = isset($_GET["id"]) ? $_GET["id"] : -1;   
    if ($id === -1) return []; 
    $productsModel = new Products(DATABASE);
    return $productsModel->getProductById($id);
}

function getFeatureProducts() {
    $productsModel = new Products(DATABASE);
    $products = $productsModel->getFeatureProduct();
    return $products;
}