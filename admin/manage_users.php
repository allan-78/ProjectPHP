<?php
$adminOnly = true;
include '../includes/auth.php';
include '../includes/header.php';

$result = $conn->query("SELECT * FROM users");

echo "<h2>Manage Users</h2>";
echo "<table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>";
while ($user = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $user['user_id'] . "</td>
            <td>" . $user['name'] . "</td>
            <td>" . $user['email'] . "</td>
            <td>" . ucfirst($user['role']) . "</td>
            <td>" . ucfirst($user['account_status']) . "</td>
            <td>
                <a href='edit_user.php?id=" . $user['user_id'] . "'>Edit</a>
                <a href='disable_user.php?id=" . $user['user_id'] . "'>Disable</a>
            </td>
          </tr>";
}
echo "</table>";
include '../includes/footer.php';
?>
