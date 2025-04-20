<?php 
require_once './app/views/partials/index.php';
require_once './app/controllers/ProductsController.php';
require_once './app/controllers/Parsedown.php';
$Parsedown = new Parsedown();
[$totalPage, $products] = getProductsWithConditions(3)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Products Management "); ?>
    <link rel="stylesheet" href="./public/css/manage.css">
</head>
<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main>
        <section>
            <h1>LIST OF BOOKS</h1>

            <div class="product-container">
                <div class="add-button-row">
                    <a class="btn btn-success  custom-display" href="?page=add">
                        Add New Book
                        &nbsp;
                        <span class="material-symbols-outlined text-white">add</span>
                    </a>
                </div>
                <div >
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Book's name</th>
                                <th class="col author">Author</th>
                                <th class="col price">Price</th>
                                <th class="col des">Description</th>
                                <th class="col cat">Category</th>
                                <th class="col act">Actions</th>
                            </tr>
                        </thead>
                        <?php foreach ($products as $product) : ?> 
                            <tr>
                                <td data-label="Book's name"><?= $product["NAME"] ?></td>
                                <td data-label="Author" class="author"><?= $product["AUTHOR"] ?></td>
                                <td data-label="Price" class="price"><?= $product["PRICE"] ?></td>
                                <td data-label="Description" class="des" title="<?= htmlspecialchars(strip_tags($product["DESCRIPTION"])) ?>">
                                    <p>
                                        <?= $Parsedown->text(mb_strimwidth(strip_tags($product["DESCRIPTION"]), 0, 100, '...')) ?>
                                    </p>
                                </td>
                                <td data-label="Category" class="cat"><?= $product["CNAME"] ?></td>
                                <td data-label="Actions" class="act">
                                    <a class="btn btn-primary table-btn" href="?page=edit&id=<?= $product['PRODUCT_ID'] ?>">Update</a>
                                    <form action="./app/controllers/BookManipulation.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="id" value="<?= $product['PRODUCT_ID'] ?>">
                                        <input type="hidden" name="type" value="delete">
                                        <button type="submit" class="btn btn-danger table-btn">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>


        </section>
        <?php renderPagination($totalPage)?>
    </main>
    <?php footer(); ?>
</body>
</html>