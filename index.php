<?php
require_once './config.php';
require_once './Database.php';

define('DATABASE', new Database(
    HOST,
    USERNAME,
    PASSWORD,
    DBNAME
)); 

session_start();

if (!isset($_SESSION['role'])) $_SESSION['role'] = 'GUEST';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include './app/views/index.php';
        break;

    case 'products':
        include './app/views/products/products.php';
        break;

    case 'product':
        include './app/views/products/product.php';
        break;

    case 'categories':
        include './app/views/categories.php';
        break;   
    
    case 'about':
        include './app/views/contact.php';
        break; 
    
    case 'login':
        if (!isset($_SESSION['role']) || $_SESSION['role'] == 'GUEST') {
            include './app/views/login/login.php';
        } else {
            include './app/views/index.php';
        }
        break; 

    case 'signup':
        if (!isset($_SESSION['role']) || $_SESSION['role'] == 'GUEST') {
            include './app/views/login/signup.php';
        } else {
            include './app/views/index.php';
        }
        break; 

    case 'mng':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') {
            include './app/views/manage.php';
        } else {
            include './app/views/401.php';
        }
        break;
    
    case 'add':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') {
            include './app/views/products/addbook.php';
        } else {
            include './app/views/401.php';
        }
        break;
    
    case 'edit':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') {
            include './app/views/products/editbook.php';
        } else {
            include './app/views/401.php';
        }
        break;

    default:
        include './app/views/404.php';
        break;
}