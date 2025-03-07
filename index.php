<?php

define('APP_PATH', __DIR__);
define('BASE_URL', './'); 

require_once 'config.php';
require_once APP_PATH . '/Database.php';

$temp = dbConfig();
define('DATABASE', new Database(
    $temp['host'],
    $temp['username'],
    $temp['password'],
    $temp['database']
));


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include APP_PATH . '\app\views\home\index.php';
        break;

    case 'products':
        include APP_PATH . '\app\views\products\index.php';
        break;

    case 'product':
        include APP_PATH . '\app\views\products\product.php';
        break;

    case 'categories':
        include APP_PATH . '\app\views\categories\index.php';
        break;   
    
    case 'about':
        include APP_PATH . '\app\views\about\index.php';
        break; 
    
    case 'login':
        include APP_PATH . '\app\views\login\index.php';
        break; 

    case 'logout':
        include APP_PATH . '\app\views\login\logout.php';
        break; 

    case 'logout':
        include APP_PATH . '\app\views\login\signup.php';
        break; 

    case 'cart':
        include APP_PATH . '\app\views\cart\index.php';
        break; 

    default:
        break;
}