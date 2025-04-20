<?php require_once './app/views/partials/index.php'; ?>
<?php require_once './app/controllers/HomeController.php' ?>
<!DOCTYPE html> 
<html lang="en"> 
<head>
<?php pageSetup("Homepage "); ?>
<link rel="stylesheet" href= "./public/css/error.css">
</head>

<body>
    <?php require_once './app/views/partials/nav.php' ?>
    <main> 
        <section>
            <h1 class="error">404</h1>
            <div class="message">Oops! The page you're looking for doesn't exist.</div>
            <p><a href="?">Go back home</a> or try searching.</p>
        </section>
    </main> 
    <?php footer(); ?>
</body> 
</html>