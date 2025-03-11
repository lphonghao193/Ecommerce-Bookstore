<?php
require_once APP_PATH . "\app\models\UsersModel.php";


$user = $_SESSION['user'];
$editing = isset($_POST['edit']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    // Sanitize input data
    // $_SESSION['user']['FNAME'] = htmlspecialchars($_POST['first_name']);
    // $_SESSION['user']['LNAME'] = htmlspecialchars($_POST['last_name']);
    // $_SESSION['user']['EMAIL'] = htmlspecialchars($_POST['email']);
    // $_SESSION['user']['PHONE_NUMBER'] = htmlspecialchars($_POST['phone']);
    // $_SESSION['user']['LOCATION'] = htmlspecialchars($_POST['location']);
    
    // Update session data
    $userModel = new Users(DATABASE);
    $userModel->updateUser($_SESSION['user']);
    $editing = false;
}
?>
