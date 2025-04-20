<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/SignUpController.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup("Sign Up "); ?>
    <link rel="stylesheet" href="./public/css/login.css">
    <script src="./public/js/signup.js" defer></script>
</head>
<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <div class="container-fluid">
        <div class="tab-container">
            <form action="index.php?page=signup" method="post">
                <div class="input-group">
                    <input placeholder="Username*" type="text" class="d-inline login-input my-2" name="username" required>
                </div>
                <div class="d-flex justify-content-between align-justify" id="username-feedback"></div>
                <div class="input-group">
                    <input placeholder="Email*" type="text" class="d-inline login-input my-2" name="email" required>
                </div>
                <div class="d-flex justify-content-between align-justify" id="email-feedback"></div>

                <div class="input-group">
                    <input placeholder="Password*" type="password" class="login-input my-2" name="password" required>
                </div>
                <div class="d-flex justify-content-between align-justify" id="password-feedback">
                </div>
                <div class="input-group">
                    <input placeholder="Confirm password*" type="password" class="login-input my-2" name="confirm-password" required>
                </div>
                <div class="d-flex justify-content-between align-justify" id="confirm-password-feedback"></div> 
                <div class="confirm my-2">
                    <p style="font-size: 15px; font-weight: 600">By clicking Sign Up, you agree to our <span style="text-decoration: underline;">Terms, Privacy Policy and Cookies Policy</span>.</p>
                    <input type="submit" value="Sign Up (Disabled)" class="btn btn-dark w-100" disabled>
                </div>
            </form>
            <div class="custom-display">
                <a href="?page=login" class="my-2 justify-content-end ">Already have an account?</a>
            </div>
        </div>
    </div>
    <?php footer(); ?>
</body>

</html>
