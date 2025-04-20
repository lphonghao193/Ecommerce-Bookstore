<?php
require_once  "./../models/UsersModel.php";
require_once  "./../models/ProductsModel.php";

require_once  './../../config.php';
require_once  './../../Database.php';
define('DATABASE', new Database(
    HOST, USERNAME, PASSWORD, DBNAME
)); 


if (isset($_GET['q'])) {
    $query = trim($_GET['q']);
    $productModel = new Products(DATABASE);
    $text = [
        'categories'=> [],
        'books' => []
    ];

    $results = $productModel->searchCategories($query);
    foreach($results as $result) {
        $text['categories'][] = [
            'id' => $result["CATEGORY_ID"],
            'name' => $result["NAME"],
            'icon' => $result["ICON"]
        ];
    }
    $results = $productModel->searchProducts($query);
    foreach($results as $result) {
        $text['books'][] = [
            'id' => $result["ID"],
            'name' => $result["NAME"],
            'category' => $result["CATEGORY"],
            'path' => "./public/assets/images/" . $result["IMAGE"]
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($text);
    exit();
}
?>
