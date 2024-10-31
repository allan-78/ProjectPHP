<?php
include 'db.php';
include 'includes/auth.php';

$userId = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM orders WHERE user_id = $userId");

echo "<h2>Your Orders</h2>";
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
            </tr>";
    while ($order = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $order['order_id'] . "</td>
                <td>$" . number_format($order['total_amount'], 2) . "</td>
                <td>" . ucfirst($order['order_status']) . "</td>
                <td>" . $order['order_date'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}
include 'includes/footer.php';
?>
