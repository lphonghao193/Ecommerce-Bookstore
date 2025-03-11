<?php 
session_start(); 
require_once APP_PATH . '/app/views/partials/index.php';
require_once APP_PATH . '/app/controllers/UserInfoController.php';

if (!isset($_SESSION['user']) || count($_SESSION['user']) == 0) {
    echo "Access to this page requires authentication. Please return to the <a href='" . BASE_URL . "'>homepage</a> or proceed to the <a href='" . BASE_URL . "?page=login'>login page</a>.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php pageSetup(); ?>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/public/css/info.css'; ?>">
    <script src="<?php echo BASE_URL . '/public/js/info.js'; ?>"></script>
</head>
<body>
    <?php navBar("info"); ?>
    <?php print_r($_SESSION['user']); ?>
    <main>
        <section class="m-3 p-3" style="background-color: #A27B5C; border-radius: 8px; color: white;">
            <h2>User Information</h2>
            
            <?php if ($editing): ?>
                <form method="POST">
                    <p><strong>First Name:</strong> <input type="text" name="first_name" value="<?php echo $user['FNAME']; ?>" required></p>
                    <p><strong>Last Name:</strong> <input type="text" name="last_name" value="<?php echo $user['LNAME']; ?>" required></p>
                    <p><strong>Email:</strong> <input type="email" name="email" value="<?php echo $user['EMAIL']; ?>" required></p>
                    <p><strong>Phone:</strong> <input type="text" name="phone" value="<?php echo $user['PHONE_NUMBER']; ?>" required></p>
                    <p><strong>Location:</strong> <input type="text" name="location" value="<?php echo $user['LOCATION']; ?>" required></p>
                    
                    <div class="d-flex justify-content-end me-3 mt-3">
                        <button type="submit" name="save" class="btn btn-success">Save Changes</button>
                        <a href="<?php echo BASE_URL . 'app/views/userInfo/logout.php'; ?>" class="btn btn-danger ms-2">Log Out</a>
                    </div>
                </form>
            <?php else: ?>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['FNAME'] . ' ' . $user['LNAME']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['USERNAME']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['EMAIL']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['PHONE_NUMBER']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($user['LOCATION']); ?></p>
                
                <form method="POST" class="d-flex justify-content-end me-3 mt-3">
                    <button type="submit" name="edit" class="btn btn-primary">Edit Profile</button>
                    <a href="<?php echo BASE_URL . 'app/views/userInfo/logout.php'; ?>" class="btn btn-danger ms-2">Log Out</a>
                </form>
            <?php endif; ?>
        </section>
    </main>
    <?php footer(); ?>
</body>
</html>