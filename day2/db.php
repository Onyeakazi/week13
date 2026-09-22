<?php
// 1. db.php - Secure Database Connection
$host = 'localhost';
$db   = 'school_db';
$user = 'root'; // XAMPP default
$pass = '';     // XAMPP default

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Db connected";
} catch (PDOException $e) {
  die("Database Connection Error: " . $e->getMessage());
}
?>