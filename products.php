<?php
include 'db.php';
include 'includes/auth.php'; // Optional if user must be logged in
include 'includes/header.php'; 

$result = $conn->query("SELECT * FROM products WHERE status='active'");

echo "<h2>Product Catalog</h2>";
echo "<div class='product-list'>";

while ($product = $result->fetch_assoc()) {
    echo "<div class='product'>";
    echo "<img src='" . $product['image_url'] . "' alt='" . $product['name'] . "'>";
    echo "<h3>" . $product['name'] . "</h3>";
    echo "<p>" . $product['description'] . "</p>";
    echo "<p>Price: $" . $product['price'] . "</p>";
    echo "<a href='product_details.php?id=" . $product['product_id'] . "'>View Details</a>";
    echo "</div>";
}

echo "</div>";
include 'includes/footer.php';
?>
