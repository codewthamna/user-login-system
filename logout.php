<?php
require 'config.php';

// If user is logged in
if (isset($_SESSION['user_id'])) {

    // Remove remember token from DB
    $stmt = $pdo->prepare(
        "UPDATE user_info SET remember_token = NULL WHERE id = ?"
    );
    $stmt->execute([$_SESSION['user_id']]);
}

// Delete remember cookie (force expire)
if (isset($_COOKIE['remember_token'])) {
    setcookie(
        "remember_token",
        "",
        time() - 3600,
        "/",
        "",
        false, // true in HTTPS
        true
    );
}

// Destroy session completely
$_SESSION = [];
session_destroy();

// Redirect to login
header("Location: login.php");
exit;
?>