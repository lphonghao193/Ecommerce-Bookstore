<?php
include_once '../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

$type = $_POST['type'] ?? '';
if (!in_array($type, ['add', 'edit', 'delete'])) {
    die("Invalid form submission.");
}

$conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if ($type === 'delete') {
    $id = $_POST['id'] ?? null;
    if (!$id) {
        die("Product ID is required for deletion.");
    }

    $query = "DELETE FROM PRODUCT WHERE PRODUCT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Book has been deleted successfully!'); window.location.href = '../../?page=mng';</script>";
    exit();
}

$name = $_POST['name'] ?? '';
$author = $_POST['author'] ?? '';
$price = $_POST['price'] ?? '';
$category_id = $_POST['categories'] ?? null;
$description = $_POST['description'] ?? '';
$image = $_FILES['image'] ?? null;

$imagePath = null;
if ($image && $image['error'] === 0) {
    $uploadDir = '../../public/assets/images/products/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid('', true) . '.' . $extension;
    $destination = $uploadDir . $newFileName;

    if (move_uploaded_file($image['tmp_name'], $destination)) {
        $imagePath = 'products/' . $newFileName;
    } else {
        die("Image upload failed.");
    }
}

// ADD
if ($type === 'add') {
    $stmt = $conn->prepare("INSERT INTO PRODUCT (NAME, AUTHOR, PRICE, CATEGORY_ID, DESCRIPTION, IMAGE) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiss", $name, $author, $price, $category_id, $description, $imagePath);
}

// EDIT
elseif ($type === 'edit') {
    $id = $_POST['id'] ?? null;
    if (!$id) {
        die("Product ID is required for editing.");
    }

    if ($imagePath) {
        $stmt = $conn->prepare("UPDATE PRODUCT SET NAME = ?, AUTHOR = ?, PRICE = ?, CATEGORY_ID = ?, DESCRIPTION = ?, IMAGE = ? WHERE PRODUCT_ID = ?");
        $stmt->bind_param("ssdissi", $name, $author, $price, $category_id, $description, $imagePath, $id);
    } else {
        $stmt = $conn->prepare("UPDATE PRODUCT SET NAME = ?, AUTHOR = ?, PRICE = ?, CATEGORY_ID = ?, DESCRIPTION = ? WHERE PRODUCT_ID = ?");
        $stmt->bind_param("ssdisi", $name, $author, $price, $category_id, $description, $id);
    }
}

// Execute and redirect
if ($stmt && $stmt->execute()) {
    echo "<script>alert('Book has been " . ($type === 'add' ? 'added' : 'updated') . " successfully!'); window.location.href = '../../?page=mng';</script>";
    exit();
} elseif ($stmt) {
    echo "Error: " . $stmt->error;
    $stmt->close();
}

$conn->close();
