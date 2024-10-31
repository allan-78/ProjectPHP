<?php
$adminOnly = true;
include '../includes/auth.php';
include '../db.php';

if (isset($_GET['id'])) {
    $orderId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if (!$order) {
        echo "Order not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderStatus = sanitize($_POST['order_status']);

    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $orderStatus, $orderId);

    if ($stmt->execute()) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error updating order: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Order</title>
</head>
<body>
    <h2>Update Order Status for Order ID: <?php echo $order['order_id']; ?></h2>
    <form method="POST">
        <select name="order_status">
            <option value="pending" <?php echo ($order['order_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="shipped" <?php echo ($order['order_status'] == 'shipped') ? 'selected' : ''; ?>>Shipped</option>
            <option value="delivered" <?php echo ($order['order_status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
            <option value="returned" <?php echo ($order['order_status'] == 'returned') ? 'selected' : ''; ?>>Returned</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
</body>
</html>
