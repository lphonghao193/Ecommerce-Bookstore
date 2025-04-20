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
            <h1 class="error">401</h1>
            <div class="message"><strong>Unauthorized Access</strong>. You don't have permission to view this page.</div>
            <p><a href="?">Return Home?</a></p>
        </section>
    </main> 
    <?php footer(); ?>
</body> 
</html>