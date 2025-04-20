<?php 
require_once './app/views/partials/index.php';
require_once './app/controllers/ProductsController.php';

// Fetch the product details
$productId = $_GET['id'] ?? 0;
$product = null;

if ($productId) {
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Edit Product "); ?>
    <link rel="stylesheet" href="./public/css/form.css">
</head>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');

        // Show current image if it exists
        const currentImage = '<?= $product['IMAGE'] ?? '' ?>';
        if (currentImage) {
            preview.src = './public/assets/images/' + currentImage;
            preview.style.display = 'block';
        }

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
        <h1>EDIT BOOK INFORMATION</h1>    
        <div class="form container">
        <form action="./app/controllers/BookManipulation.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="edit">
            <input type="hidden" name="id" value="<?= $productId ?>">

            <div class="form-group">
                <label for="name">Book's name</label>
                <input type="text" name="name" class="input" value="<?= htmlspecialchars($product['NAME'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="input" value="<?= htmlspecialchars($product['AUTHOR'] ?? '') ?>" required>
            </div>

            <div class="form-group-2">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="input" value="<?= htmlspecialchars($product['PRICE'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="categories">Category</label>
                    <select name="categories" class="input" required>
                        <option value="0" disabled>Select category</option>
                        <?php 
                        $categories = getCategories();
                        foreach ($categories as $c):
                            $selected = ($c['CATEGORY_ID'] == $product['CATEGORY_ID']) ? 'selected' : '';
                        ?>
                            <option value="<?= $c['CATEGORY_ID'] ?>" <?= $selected ?>><?= $c['NAME'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="8" required><?= htmlspecialchars($product['DESCRIPTION'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Book Cover</label>
                <input type="file" name="image" id="image" accept="image/*">
                <img id="preview" src="#" alt="Image preview" style="display: none; max-width: 200px; margin-top: 10px; border-radius: 8px;" />
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-light" type="submit">Save Changes</button>
            </div>
        </form>
        </div>
        </section>
    </main>
    <?php footer(); ?>
</body>
</html>
