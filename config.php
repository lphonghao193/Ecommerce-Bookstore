<?php

function dbConfig() {
    $db = Array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '1234',
        'database' => 'ecommerce'
    );
    return $db;
}

function getHashKey() {
    return "1";
}

?>