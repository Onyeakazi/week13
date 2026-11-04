<?php
// auth_login.php (Secure verification process)
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars($_POST['email']);
  $password = $_POST['password'];

  // 1. Fetch user records using a secure prepared statement
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // 2. Verify password against database BCRYPT hash
  if ($user && password_verify($password, $user['password_hash'])) {
    // Start session and write user flags
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    
    header("Location: dashboard.php");
    exit;
  } else {
    echo "Invalid credentials.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="auth_login.php" method="POST">
        <div>
            <label for="">Email</label>
            <input type="email" name="email">
        </div><br>
        <div>
            <label for="">Password</label>
            <input type="password" name="password">
        </div><br>

        <input type="submit">
    </form>
</body>
</html>