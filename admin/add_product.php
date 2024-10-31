<?php
$adminOnly = true;
include '../includes/auth.php';
include '../db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $brand = sanitize($_POST['brand']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category = sanitize($_POST['category']);
    $image_url = sanitize($_POST['image_url']);
    $description = sanitize($_POST['description']);
    
    $stmt = $conn->prepare("INSERT INTO products (name, brand, price, stock, description, image_url, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsiss", $name, $brand, $price, $stock, $description, $image_url, $category);
    
    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
