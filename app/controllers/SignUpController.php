<?php
require_once "./app/models/UsersModel.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = '';
    $password = '';
    $email = '';
    $pnum = '';
    $fname = '';
    $lname = '';
    $location = '';

    if (isset($_POST['username'])) $username = $_POST['username'];
    if (isset($_POST['password'])) $password = $_POST['password'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['pnum'])) $pnum = $_POST['pnum'];
    if (isset($_POST['fname'])) $fname = $_POST['fname'];
    if (isset($_POST['lname'])) $lname = $_POST['lname'];
    if (isset($_POST['location'])) $location = $_POST['location'];

    $userModel = new Users(DATABASE);
    $t = $userModel->addUser($username, $password, $email);
    if ($t) {
        echo "<script>
                alert('Register successfully! Please login again.');
                window.location.href = '?page=login';
            </script>";
        exit;
    }
}
?>
