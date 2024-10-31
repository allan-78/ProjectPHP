<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($adminOnly) && $adminOnly && $_SESSION['role'] !== 'admin') {
    header("Location: products.php"); // Redirect non-admins to products page
    exit();
}
?>
