<?php
// 2. Insert Data Safely (register.php)
require 'db.php';

$email = "john@test.com";
// PHP has built-in bcrypt hashing!
$password_hash = password_hash("mySecret123", PASSWORD_BCRYPT); 

// Prepare the SQL string with ? placeholders
$stmt = $pdo->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");

// Execute the statement by passing the actual variables in an array
$stmt->execute([$email, $password_hash]);

echo "User registered successfully!";
?>