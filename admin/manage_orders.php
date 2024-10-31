<?php
$adminOnly = true;
include '../includes/auth.php';
include '../includes/header.php';

$result = $conn->query("SELECT * FROM orders");

echo "<h2>Manage Orders</h2>";
echo "<table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>";
while ($order = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $order['order_id'] . "</td>
            <td>" . $order['user_id'] . "</td>
            <td>$" . number_format($order['total_amount'], 2) . "</td>
            <td>" . ucfirst($order['order_status']) . "</td>
            <td>" . $order['order_date'] . "</td>
            <td>
                <a href='update_order.php?id=" . $order['order_id'] . "'>Update</a>
                <a href='delete_order.php?id=" . $order['order_id'] . "'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
include '../includes/footer.php';
?>
