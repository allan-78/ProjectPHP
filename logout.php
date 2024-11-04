<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Log out user by clearing all session data and destroying the session
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session to fully log out

    // Redirect to the login page with a success message
    header("Location: login.php?logout=success");
    exit();
} else {
    // If no active session, redirect directly to the login page
    header("Location: login.php");
    exit();
}
?>
