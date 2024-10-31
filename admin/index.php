<?php
$adminOnly = true; // Require admin access
include '../includes/auth.php';
include '../includes/header.php';

echo "<h2>Admin Dashboard</h2>";
echo "<div class='metrics'>
        <div class='metric'>Total Products: <span>230</span></div>
        <div class='metric'>Total Orders: <span>150</span></div>
        <div class='metric'>Total Users: <span>100</span></div>
      </div>";
include '../includes/footer.php';
?>
