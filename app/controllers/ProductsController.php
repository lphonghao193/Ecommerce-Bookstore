<?php
require_once "./app/models/ProductsModel.php";
require_once "./app/models/CategoriesModel.php";

if (!empty($_POST['clear']) && $_POST['clear'] == 1) {
    unset($_POST['sort-price'], $_POST['sort-name']);
}

function getCategories() {
    $categoriesModel = new Categories(DATABASE);
    return $categoriesModel->getCategories();
}

function getSelectedCategories() {
    return $_GET['filter-category'] ?? [];
}

function getPriceRange() {
    $start = !empty($_GET['filter-price-start']) && is_numeric($_GET['filter-price-start']) ? $_GET['filter-price-start'] : -1;
    $end = !empty($_GET['filter-price-end']) && is_numeric($_GET['filter-price-end']) ? $_GET['filter-price-end'] : -1;
    return [$start, $end];
}

function getPageNumber() {
    return isset($_GET['page_id']) && is_numeric($_GET['page_id']) ? (int)$_GET['page_id'] : 1;
}

function getProductsWithConditions($limit = 12) {

    $page = $_GET['pgn'] ?? 1;
    $offset = ($page - 1) * $limit;

    $productsModel = new Products(DATABASE);
    $sortPrice = $_GET['sort-price'] ?? null;
    $sortName = $_GET['sort-name'] ?? null;
    $whereClauses = [];

    $selectedCategories = getSelectedCategories();
    if (!empty($selectedCategories)) {
        $whereClauses[] = "P.CATEGORY_ID IN (" . implode(", ", $selectedCategories) . ")";
    }

    list($priceStart, $priceEnd) = getPriceRange();
    if ($priceStart != -1) $whereClauses[] = "P.PRICE >= $priceStart";
    if ($priceEnd != -1) $whereClauses[] = "P.PRICE <= $priceEnd";

    $orderBy = [];
    if ($sortPrice == 1) $orderBy[] = "P.PRICE ASC";
    elseif ($sortPrice == 2) $orderBy[] = "P.PRICE DESC";

    if ($sortName == 1) $orderBy[] = "P.NAME ASC";
    elseif ($sortName == 2) $orderBy[] = "P.NAME DESC";

    // Fetch paginated products
    $products = $productsModel->getProductsWithConditions($whereClauses, $orderBy, $limit, $offset);

    // Get total filtered product count for pagination
    $allFilteredProducts = $productsModel->getProductsWithConditions($whereClauses, $orderBy);
    $productsCount = count($allFilteredProducts);

    // Calculate total pages
    $totalPage = ceil($productsCount / $limit);

    return [$totalPage, $products];
}


function getProduct() {
    $id = $_GET['id'] ?? -1;
    if ($id === -1) return [];
    $productsModel = new Products(DATABASE);
    return $productsModel->getProductById($id);
}

function getProducts() {
    $productsModel = new Products(DATABASE);
    return $productsModel->getProducts();
}

function getFeatureProducts() {
    $productsModel = new Products(DATABASE);
    return $productsModel->getFeatureProduct();
}
