<?php
require 'config.php';
require 'functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

//csrf check
if (
    !isset($_SESSION['csrf_token']) ||
    !isset($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    die("Invalid CSRF token");
}


$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');


// BASIC VALIDATION
if ($username === '' || $email === '' || $password === '') {
    showMessage("Please fill all fields");
    return; // stop execution, but page still renders
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showMessage("Invalid email format");
    return;
}

//password legnth
if (strlen($password) < 6 ||
        !preg_match('/[A-Z]/',$password) ||
         !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W]/', $password)){
        showMessage("Password must be at least 6 chars, include uppercase, lowercase, number & special char");
        return;
   
}
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// CHECK EXISTING USER
$stmt = $pdo->prepare(
    "SELECT id FROM user_info WHERE username = ? OR email = ?"
);
//$stmt->bind_param("ss", $username, $email);
$stmt->execute([$username, $email]);
//$stmt->store_result();
 if ($stmt->fetch()) {
        showMessage("Signup failed. Try different username/email.");
        return;
    }
// if ($stmt->num_rows > 0) {
    // die("Username or Email already exists");
// }


 // Insert user
    $stmt = $pdo->prepare("INSERT INTO user_info (username,email,password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashed_password])) {
        showMessage( "✅ Signup successful. You can now login.","success");
    } else {
        showMessage( "❌ Signup failed. Try again.");
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
<!-- sign up form-->
 <form action="signup.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
    <div id="signupmsg">
        <?php echo $message ?? ''; ?>
    </div>
    <div id="log">
        <h1>Create Account  </h1>
        <div id="newUserDiv"> Enter User name : <input type="text" id="newusername"  name="username" placeholder="username" required></div>
        <div id="newEmailDiv"> Enter Email : <input type="email" id="newemail" name="email"  placeholder="Email" required> </div>
        <div id="newPasswordDiv">  Enter Password : <input type="password" id="newpassword" name="password"  placeholder="password" required></div>
        <button type="submit" id="signupBtn">Sign up</button>
        <p id="signupmsg"></p>
        <p>
            Already have an account?
            <a href="login.php"> Login</a>
        </p>
    </div>
    </main>
    <script src="loginInfo.js"></script>
    <script src="signing.js"></script>
</form>
</body>
</html>