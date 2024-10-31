<?php
$adminOnly = true;
include '../includes/auth.php';
include '../includes/header.php';

$result = $conn->query("SELECT * FROM orders");

echo "<h2>Transaction History</h2>";
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>";
    while ($order = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $order['order_id'] . "</td>
                <td>" . $order['user_id'] . "</td>
                <td>$" . number_format($order['total_amount'], 2) . "</td>
                <td>" . ucfirst($order['order_status']) . "</td>
                <td>" . $order['order_date'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No transactions found.</p>";
}
include '../includes/footer.php';
?>
