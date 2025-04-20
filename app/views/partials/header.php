<?php
function pageSetup($title = "") {
    if ($title !== "") $title .= " |";
    echo <<<_END
    <title>$title Inkspire</title> 

    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="Discover a wide range of books from fiction, horror, to self-help at unbeatable prices. Fast delivery and secure checkout. Shop now at our online bookstore!">
    <meta name="keywords" content="books, online bookstore, buy books, best books, horror novels, self-help books, fiction, non-fiction, affordable books, book shopping">
    <meta name="author" content="Inkspire">
    <meta property="og:title" content="Online Bookstore | Best Books at Great Prices">
    <meta property="og:description" content="Browse thousands of titles including horror, self-help, fiction and more. Find your next favorite book today.">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    
    <!-- EasyMDE CSS -->
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <!-- EasyMDE JS -->
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/pagination.css">
    <script src="./public/js/index.js"></script>
    <script src="./public/js/nav.js"></script>
    <link rel="stylesheet" href="public/css/nav.css">
    <script src="./public/js/index.js"></script>
    _END;
}