<?php
require_once APP_PATH . "\app\models\UsersModel.php";

function encryptPassword($psw) {
    // return $hash = hash_hmac('sha256', $psw, getHashKey());
    return $psw;
}

// function sanitizeString($var) { 
// 	$var = stripslashes($var); 
// 	$var = htmlentities($var); 
// 	$var = strip_tags($var); 
// 	return $var; 
// } 
// function sanitizeMySQL($connection, $var) { 
// 	// Using the mysqli extension 
// 	$var = $connection->real_escape_string($var); 
// 	$var = sanitizeString($var); 
// 	return $var; 
// }

function getUserInfomation() {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
	$usersModel = new Users(DATABASE);
    $userInfo = $usersModel->getUser($username, $password);
	if ($userInfo) return $userInfo;
	else return [];
}

function getUserCart($username) {
	$usersModel = new Users(DATABASE);
    return $usersModel->getUserCart($username);
}

function processUser() {
    if (isset($_POST['username'])) {
        $_SESSION['tempUsername'] = $_POST["username"];
    }

    $user = getUserInfomation();

    if (!empty($user)) {
        $_SESSION['role'] = $user["ROLE"];
        $_SESSION['logIn'] = true;
        $_SESSION['cart'] = getUserCart($user["USERNAME"]);

        unset($_SESSION['tempUsername']);
        echo "<script>window.location.href = \"index.php\"</script>";
    } else {
        // $_SESSION['error'] = "Incorrect username or password!"; 
        // echo "<script>window.location.href = \"index.php?page=login\"</script>";
    }
}
?>
