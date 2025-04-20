<?php 
require_once './app/views/partials/index.php';
require_once './app/controllers/ProductsController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Add Product "); ?>
    <link rel="stylesheet" href="./public/css/form.css">


</head>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
        const easyMDE = new EasyMDE({
            element: document.getElementById("description"),
            spellChecker: false,
            toolbar: [
                "bold", "italic", "heading", "|",
                "quote", "unordered-list", "ordered-list", "|",
                "link", "image", "|",
                "preview", "side-by-side", "fullscreen", "|",
                "guide"
            ],
            renderingConfig: {
                singleLineBreaks: false,
                codeSyntaxHighlighting: true,
            }
        });
    
    });
</script>




<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main>
        <section>
        <h1>ADD NEW BOOK</h1>    
        <div class="form container">
        <form action="./app/controllers/BookManipulation.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="add">
            <div class="form-group">
                <label for="name">Book's name</label>
                <input type="text" name="name" id="" class="input" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="" class="input" required>
            </div>

            <div class="form-group-2">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="" class="input" required>
                </div>
                <div class="form-group">
                    <label for="categories">Category</label>
                    <select name="categories" id="" class="input" required>
                        <option value="0" selected disabled>Select category</option>
                        <?php $categories = getCategories(); ?>
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['CATEGORY_ID'] ?>"><?= $c['NAME'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="8"></textarea>
            </div>


            <div class="form-group">
                <label for="image">Book Cover</label>
                <input type="file" name="image" id="image" accept="image/*">
                <img id="preview" src="#" alt="Image preview" style="display: none; max-width: 200px; margin-top: 10px; border-radius: 8px;" />
            </div>


            <div class="d-flex justify-content-end">
                <button class="btn btn-light" type="submit">Add Book</button>
            </div>
        </form>
        </div>
        </section>
    </main>
    <?php footer(); ?>
</body>


</html>