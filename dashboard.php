<?php
require 'config.php';

// Auto-login using remember me
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $hashedToken = hash('sha256', $token);

    $stmt = $pdo->prepare("SELECT id, username FROM user_info WHERE remember_token = ?");
    $stmt->execute([$hashedToken]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }
}

// Require login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
<a href="logout.php">Logout</a>