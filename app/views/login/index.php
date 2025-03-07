<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\LoginController.php' ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . 'public/css/login.css'?>">
<script src= "<?php echo BASE_URL . 'public/js/login.js'?>"></script>
</head>


<body>
    <?php navBar("log"); ?>
    <main>

    <section>
        <form action="<?=BASE_URL . 'index.php?page=login'?>" method="post">
            <label for="username" class="">Username:</label>
            <input type="text" name="username" id="" value="<?php if (isset($_SESSION["tempUsername"])) echo $_SESSION["tempUsername"]; else "";?>">
            <br>
            <label for="password" class="">Password:</label>
            <input type="password" name="password" id="">
            <br>
            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </section>
    <section>
        <?php processUser(); ?>
    </section>
    </main>
    <?php footer(); ?>
</body>

</html>