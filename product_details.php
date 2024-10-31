<?php
include 'db.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        echo "<h2>" . $product['name']
echo "</h2>";
        echo "<img src='" . $product['image_url'] . "' alt='" . $product['name'] . "'>";
        echo "<p>" . $product['description'] . "</p>";
        echo "<p>Price: $" . $product['price'] . "</p>";
        echo "<form method='POST' action='cart.php'>
                <input type='hidden' name='product_id' value='" . $product['product_id'] . "'>
                <input type='number' name='quantity' min='1' max='" . $product['stock'] . "' value='1'>
                <button type='submit'>Add to Cart</button>
              </form>";
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>No product selected.</p>";
}

include 'includes/footer.php';
?>
