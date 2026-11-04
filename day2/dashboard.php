<?php
// dashboard.php (Protected Page Gate)
session_start();

// Redirect guest users to login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

echo "Welcome to the Secure Dashboard, " . $_SESSION['user_email'];
echo "<br><a href='logout.php'>Logout</a>";
?>