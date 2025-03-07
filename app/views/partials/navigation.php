<?php
function navBar($activeNav) {
    $homePath = BASE_URL . "index.php";
    $productsPath = BASE_URL . "index.php?page=products";
    $categoriesPath = BASE_URL . "index.php?page=categories";
    $aboutPath = BASE_URL . "index.php?page=about";
    $cartPath = BASE_URL . "index.php?page=cart";
    $loginPath = BASE_URL . "index.php?page=login";
    $navHome = $activeNav == "home" ? "active" : "";
    $navProd = $activeNav == "prod" ? "active" : "";
    $navCateg = $activeNav == "categ" ? "active" : "";
    $navAbout = $activeNav == "about" ? "active" : "";
    $navCart = $activeNav == "cart" ? "active" : "";
    $navLog = $activeNav == "log" ? "active" : "";

    $loginButton = "";
    if (!isset($_SESSION['logIn']) || $_SESSION['logIn'] === false) {
        $loginButton =  "<button style=\"border: none; background-color: #DCD7C9\"><a href=\"$loginPath\" class = \"fs-5\">Log in</a></button>";
    } else {
        $loginButton =  "<a href=\"$loginPath\" class = \"$navLog\">"
                    .   "<i class=\"bi bi-person-fill fs-2\"></i>"
                    .   "</a>";
    }
    
    echo <<<_END
    <header class="nav-pc">
        <div class="top-nav container-fluid d-flex justify-content-between align-items-center mb-3">
            
            <h1 class="logo justify-content-start align-items-center m-0">
                <a href="$homePath" class="text-decoration-none">INKSPIRE</a>
            </h1>

            <form action="" class="search-bar custom-display">
                <input type="text" class="form-control me-2" placeholder="Search" aria-label="Search">
                <!-- <button type="submit" class="btn btn-outline-primary">Search</button> -->
            </form>


            <div class="d-flex justify-content-end">
                <a href="$cartPath" class="$navCart me-3">
                    <i class="bi bi-cart-fill fs-3"></i>
                </a>
                $loginButton
            </div>
        </div>
    _END;
    echo <<<_END
        <nav class="bot-nav d-inline-block w-100 container-fluid">
            <ul class="p-0">
                <li class="d-inline">
                    <a href="$homePath" class="$navHome fs-5">
                        <i class="bi bi-house-door-fill"></i>
                        Home
                    </a>
                </li>
                <li class="d-inline">
                    <a href="$productsPath" class="$navProd fs-5">
                        <i class="bi bi-book-fill"></i>
                        Products
                    </a>
                </li>
                <li class="d-inline">
                    <a href="$categoriesPath" class="$navCateg fs-5">
                        <i class="bi bi-tag-fill"></i>
                        Categories
                    </a>
                </li>
                <li class="d-inline m-0">
                    <a href="$aboutPath" class="$navAbout fs-5">
                        <i class="bi bi-info-circle-fill"></i>
                        About
                    </a>
                </li>

            </ul>
        </nav>
    </header>
    _END;
    echo <<<_END
    <header class="nav-mb">
        <div class="top-nav container-fluid d-flex justify-content-between align-items-center mb-3">
            
            <h1 class="logo justify-content-start align-items-center m-0">
                <a href="$homePath" class="text-decoration-none">INKSPIRE</a>
            </h1>

            <div class="d-flex justify-content-end align-items-center">
                <a href="$cartPath" class="me-3">
                    <i class="bi bi-cart-fill fs-3"></i>
                </a>
                $loginButton
                <button class="show-nav-btn" onclick="showNav()">
                    <i class="bi bi-list fs-1"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Full-Screen Overlay: To show on mobile -->
    <div id="overlay-nav" class="overlay">
        <button class="close-btn" onclick="closeNav()"><i class="bi bi-x-lg fs-1"></i></button>
        <br>
        <br>
        <br>
        <br>
        <form action="" class="justify-content-center align-items-center">
            <input type="text" class="form-control me-2" placeholder="Search" aria-label="Search">
            <!-- <button type="submit" class="btn btn-outline-primary">Search</button> -->
        </form>
        <ul class="overlay-menu">
            <li class="m-5">
                <a href="$homePath"  class="$navHome fs-5">
                    <i class="bi bi-house-door-fill"></i>
                    Home
                </a>
            </li>
            <li class="m-5">
                <a href="$productsPath"  class="$navProd fs-5">
                    <i class="bi bi-book-fill"></i>
                    Products
                </a>
            </li>
            <li class="m-5">
                <a href="$categoriesPath"  class="$navCateg fs-5">
                    <i class="bi bi-tag-fill"></i>
                    Categories
                </a>
            </li>
            <li class="m-5">
                <a href="$aboutPath"  class="$navAbout fs-5">
                    <i class="bi bi-info-circle-fill"></i>
                    About
                </a>
            </li>
        </ul>
    </div>
    _END;
}
