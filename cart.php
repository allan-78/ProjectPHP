<?php
include 'db.php';
include 'includes/auth.php'; // Ensure user is logged in

session_start();

// Initialize the cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding product to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Check if product is already in the cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity; // Update quantity
    } else {
        $_SESSION['cart'][$productId] = $quantity; // Add new product
    }
}

// Handle cart display
echo "<h2>Your Shopping Cart</h2>";
if (!empty($_SESSION['cart'])) {
    echo "<ul>";
    $totalAmount = 0;

    foreach ($_SESSION['cart'] as $id => $qty) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $price = $product['price'] * $qty;
            $totalAmount += $price;
            echo "<li>" . $product['name'] . " (Qty: $qty) - $" . number_format($price, 2) . "</li>";
        }
    }
    echo "</ul>";
    echo "<h3>Total Amount: $" . number_format($totalAmount, 2) . "</h3>";
    echo "<form method='POST' action='orders.php'>
            <button type='submit'>Proceed to Checkout</button>
          </form>";
} else {
    echo "<p>Your cart is empty.</p>";
}
include 'includes/footer.php';
?>
