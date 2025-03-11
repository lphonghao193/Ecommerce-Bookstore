<?php session_start() ?> 
<?php require_once APP_PATH . '\app\views\partials\index.php'; ?>
<?php require_once APP_PATH . '\app\controllers\CategoriesController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup(); ?>
<link rel="stylesheet" href= "<?php echo BASE_URL . '/public/css/categories.css'?>">
<script src= "<?php echo BASE_URL . '/public/js/categories.js'?>"></script>
</head>

<body> 
    <?php navBar("categ"); ?>
    <main> 

    <section class="product-list justify-content-center align-items-center">
            <div class="row">
                <?php $categories = getCategories(); ?>
                <?php foreach ($categories as $category): ?>
                    <?php $id = $category["ID"];
                    $name = $category["NAME"];
                    $icon = $category["ICON"];
                    $href = ""; ?>
                    <div class="col-6 col-sm-3 text-center d-flex flex-column align-items-center">
                        <a href="<?= BASE_URL . 'index.php?page=products&filter-category[]='. $id?>"  style="color: black; width = 5cm; text-decoration: none; padding: 20px">
                            <div >
                                <i class= "<?= $icon ?>" style="font-size: 50pt" ></i>
                            </div>    
                            <h6 class="fw-bold"><?= $name ?></h6>
                        </a>
                    </div>
                    <?php endforeach; ?>
                

            </div>
    </section>




    </main> 
    <?php footer(); ?>
</body> 
</html>
