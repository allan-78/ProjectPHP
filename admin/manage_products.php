<?php
$adminOnly = true;
include '../includes/auth.php';
include '../includes/header.php';

$result = $conn->query("SELECT * FROM products");

echo "<h2>Manage Products</h2>";
echo "<table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>";
while ($product = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $product['product_id'] . "</td>
            <td>" . $product['name'] . "</td>
            <td>$" . number_format($product['price'], 2) . "</td>
            <td>" . $product['stock'] . "</td>
            <td>" . ucfirst($product['status']) . "</td>
            <td>
                <a href='edit_product.php?id=" . $product['product_id'] . "'>Edit</a>
                <a href='delete_product.php?id=" . $product['product_id'] . "'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

echo "<h3>Add New Product</h3>";
echo "<form method='POST' action='add_product.php'>
        <input type='text' name='name' placeholder='Product Name' required>
        <input type='text' name='brand' placeholder='Brand' required>
        <input type='number' name='price' placeholder='Price' required step='0.01'>
        <input type='number' name='stock' placeholder='Stock' required>
        <input type='text' name='category' placeholder='Category' required>
        <input type='text' name='image_url' placeholder='Image URL' required>
        <textarea name='description' placeholder='Product Description'></textarea>
        <button type='submit'>Add Product</button>
      </form>";

include '../includes/footer.php';
?>
