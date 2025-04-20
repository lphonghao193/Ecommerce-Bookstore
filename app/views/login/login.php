<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/LoginController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Login"); ?>
    <link rel="stylesheet" href="public/css/login.css">
    <script src="public/js/login.js" defer></script>
</head>
<body>
    <?php require_once './app/views/partials/nav.php' ?>

    <div class="container-fluid">
        <div class="tab-container">
            <h2>
                WELCOME!
            </h2>
            <form action="index.php?page=login" method="post">
                <div class="input-group">
                    <input placeholder="Username" type="text" class="d-inline login-input my-2" name="username" required>
                </div>
                <div class="input-group">
                    <input placeholder="Password" type="password" class="login-input my-2" name="password" required>
                </div>
                <div class="input-group my-3">
                    <label for="type" class="custom-display">You're logging in as an </label>
                    <select name="type" id="login-type" class="custom-display">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="confirm my-3">
                    <input type="submit" value="Login" class="btn btn-dark w-100">
                </div>
            </form>
            <div class="custom-display">
                <a href="?page=login" class="justify-content-end ">Forgotten password?</a>
            </div>
            <hr>
            <a href="?page=signup" style="color: white;">
                <button class="btn btn-light w-100">
                    Create new account
                </button>

            </a>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>
