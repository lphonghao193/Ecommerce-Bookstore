<header>
    <div class="navbar">
        <!-- Left Section: Logo + Search -->
        <div class="nav-left">
            <a href="?page=home" class="logo-link">
                <img src="public/assets/images/logo.png" alt="logo" class="logo-img">
            </a>
            <form action="" class="search-bar">
                <input type="text" id="search-box" placeholder="Search" aria-label="Search">
            </form>
        </div>

        <!-- Center Section: Navigation Links -->
        <nav class="nav-center">
            <ul class="nav-links">
                <li><a href="?page=home" title="Home" class="<?= !isset($_GET['page']) || $_GET['page'] === "home" ? "active" : ""?>">Home</a></li>
                <li><a href="?page=products" title="Products" class="<?= isset($_GET['page']) && ($_GET['page'] === "products" || $_GET['page'] === "product") ? "active" : ""?>">Products</a></li>
                <li><a href="?page=categories" title="Categories" class="<?= isset($_GET['page']) && ($_GET['page'] === "categories") ? "active" : ""?>">Categories</a></li>
                <li><a href="?page=about" title="About" class="<?= isset($_GET['page']) && ($_GET['page'] === "about") ? "active" : ""?>">Contact</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') : ?>
                    <li><a href="?page=mng" title="Manage" class="<?= isset($_GET['page']) && ($_GET['page'] === "mng" || $_GET['page'] === "add" || $_GET['page'] === "edit") ? "active" : ""?>">Products Management</a></li>
                <?php endif ?>
            </ul>
        </nav>

        <!-- Right Section: User Button -->
        <div class="nav-right">
            <button class="nav-btn">
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] == 'GUEST') : ?>
                    <a href="?page=login" title="Login">
                        <i class="material-symbols-outlined">login</i>
                    </a>
                <?php else: ?>
                    <button id="info" class="menu-btn" title="Profile">
                        <span class="material-symbols-outlined">person</span>
                    </button>
                <?php endif ?>
            </button>

            <!-- Menu Icon for Mobile -->
            <button class="menu-btn">
                <span class="material-symbols-outlined menu-icon" id="menu">
                    menu
                </span>
            </button>
        </div>

    </div>

    <!-- Mobile Popup Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="?page=home">Home</a></li>
            <li><a href="?page=products">Products</a></li>
            <li><a href="?page=categories">Categories</a></li>
            <li><a href="?page=about">Contact</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') : ?>
                <li><a href="?page=mng">Products Management</a></li>
            <?php endif ?>
        </ul>
    </div>

        <!-- Info Popup Menu -->
    <div class="mobile-menu" id="infoMenu">
        <ul>
            <li><a href=""><?= $_SESSION['mail'] ?></a></li>
            <li><a href="./app/views/userInfo/logout.php" style="color: red">Log Out</a></li>
        </ul>
    </div>


    <div id="search-results" class="search-results"></div>
</header>

<script>

</script>

