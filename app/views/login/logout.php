<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\ProductsController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . 'public/css/products.css'?>">
<script src= "<?php echo BASE_URL . 'public/js/products.js'?>"></script>
</head>


<body>
    <?php navBar("log"); ?>
    <main>

    </main>
    <?php footer(); ?>
</body>

</html>