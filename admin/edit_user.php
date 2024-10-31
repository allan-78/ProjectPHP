<?php
$adminOnly = true;
include '../includes/auth.php';
include '../db.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $role = sanitize($_POST['role']);
    $status = sanitize($_POST['account_status']);

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ?, account_status = ? WHERE user_id = ?");
    $stmt->bind_param("ssssi", $name, $email, $role, $status, $userId);

    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User: <?php echo $user['name']; ?></h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <select name="role">
            <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
        <select name="account_status">
            <option value="active" <?php echo ($user['account_status'] == 'active') ? 'selected' : ''; ?>>Active</option>
            <option value="disabled" <?php echo ($user['account_status'] == 'disabled') ? 'selected' : ''; ?>>Disabled</option>
        </select>
        <button type="submit">Update User</button>
    </form>
</body>
</html>
