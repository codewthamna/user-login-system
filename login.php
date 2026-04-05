<?php
require 'config.php';
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (
    !isset($_SESSION['csrf_token']) ||
    !isset($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
   $message= showMessage("Invalid CSRF token");
   return;
}



$login    = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$remember= isset($_POST['remember_me']);

// VALIDATION
if ($login === '' || $password === '') {
   $message= showMessage("All fields are required");
    return;
}

// FETCH USER
$stmt = $pdo->prepare(
    "SELECT id, username, password,remember_token FROM user_info
     WHERE username = ? OR email = ?"
);

$stmt->execute([$login, $login]);
 $user = $stmt->fetch(PDO::FETCH_ASSOC);

 if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Remember me
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            $hashedToken = hash('sha256', $token);

            setcookie(
                "remember_token",
                $token,
                time() + (30*24*60*60),
                "/",
                "",
                true,  // secure HTTPS only
                true   // HttpOnly
            );

            $stmt2 = $pdo->prepare("UPDATE user_info SET remember_token = ? WHERE id = ?");
            $stmt2->execute([$hashedToken, $user['id']]);
        }
        header("Location: dashboard.php");
        exit();
    }

   $message= showMessage("❌ Invalid login details");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>USER LOG IN PAGE </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form id="loginForm" action="login.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div id="loginmsg">
        <?php echo $message ?? ''; ?>
    </div>
  <main>
<div id="log">
    <h1>User Login Page</h1>
    <p> Don't have an account! <a href="signup.php">Create an account</a></p>
    
    <div id="box1"> User name or E mail : 
        <input type="text" id="username" name="username" required>
    </div>
    <br>
<div id="box2"> Enter Password : 
    <input type="password" id="password" name="password" required>
</div>

<div id="box3">
   <label for="keepLogged">Keep me logged in</label>
        <input type="checkbox" id="keepLogged" name="remember_me"> 
     </div>
    
<div>
   <button type="submit" id="loginBtn">Log in</button>
</div>


   <p id="message"></p>
</div>

  </main>  

  <footer>

  </footer>
 
</form>
 <script src="loginInfo.js"></script>
  <script src="signing.js"></script>
</body>
</html>

