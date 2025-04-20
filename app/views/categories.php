<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/CategoriesController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php pageSetup("Categories "); ?>
<link rel="stylesheet" href= "./public/css/categories.css">
</head>

<body> 
    <?php require_once './app/views/partials/nav.php' ?>
    <main> 

    <section>
            <div class="row">
                <?php $categories = getCategories(); ?>
                <?php foreach ($categories as $category): ?>
                    <?php $id = $category["CATEGORY_ID"];
                    $name = $category["NAME"];
                    $des = $category["DESCRIPTION"];
                    $href = ""; ?>
                    <div class="col-6 col-sm-3 text-center d-flex flex-column align-items-center category" onclick="window.location.href='?page=products&filter-category[]=<?=$id?>'">
                        <div >
                            <i class="material-symbols-outlined" style="font-size: 50pt; margin-bottom: 10px"><?= $category['ICON'] ?></i>
                        </div>   

                        <h5><?= $name ?></h5>
                        <h6><?=$des?></h6>
                    </div>
                    <?php endforeach; ?>
                

            </div>
    </section>




    </main> 
    <?php footer(); ?>
</body> 
</html>
