<?php
require_once '../models/UsersModel.php';
require_once '../../config.php';
require_once '../../Database.php';
define('DATABASE', new Database(
    HOST, USERNAME, PASSWORD, DBNAME
)); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $userModel = new Users(DATABASE);

    if (strlen($username) < 6 || strlen($username) > 30) {
        echo 'Username must be at least 6 characters and at most 30 characters.';
    }
    elseif (!preg_match('/^[a-zA-Z0-9._-]{6,30}$/', $username)) {
        echo 'Username can only contain letters, numbers, dots (.), underscores (_), and hyphens (-), and must be 6 to 30 characters long.';
    }
    elseif (!$userModel->checkUsername($username)) {
        echo 'Username is already registered!';
    }
    else {
        echo '';
    }

    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) {
        
    $password = $_POST['password'];

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\S]{6,}$/', $password)) {
        echo "Password must be at least 6 characters long and include at least one letter, one number, and one special character.";
    } else {
        echo "Valid password.";
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $email = str_replace(' ', '', $email); // Remove spaces

    $userModel = new Users(DATABASE);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    if (!$userModel->checkEmail($email)) {
        echo 'Email is already registered!';
        exit;
    }

    echo "";
    exit;
}
?>
