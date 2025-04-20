<?php
require_once "./app/models/UsersModel.php";

function getUserInformation() {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "1"; 

    $usersModel = new Users(DATABASE);
    return $usersModel->getUser($username, $password, $type);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $user = getUserInformation();
    
    if (!empty($user)) {
        $_SESSION['role'] = $user['ROLE'];
        $_SESSION['id'] = $user['USER_ID'];
        $_SESSION['name'] = $user['USERNAME'];
        $_SESSION['mail'] = $user['EMAIL'];
        header("Location: index.php"); 
        exit;
    } else {
        echo <<<_END
            <script>
                alert("Incorrect username or password");
            </script>
        _END; 
    }
}