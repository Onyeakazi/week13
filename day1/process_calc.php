<?php
// process_calc.php (The Controller)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Check if the request method was actually POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // 2. Extract inputs (sanitizing strings to prevent XSS script tags)
  $n1 = htmlspecialchars($_POST["num1"]);
  $n2 = htmlspecialchars($_POST["num2"]);
  $op = htmlspecialchars($_POST["operation"]);

  // 3. Validation utility checks
  if (empty($n1) || empty($n2) || empty($op)) {
    die("Error: All inputs are required.");
  }

  // 4. Custom calculation logic
  $result = 0;
  if ($op === "add") {
    $result = $n1 + $n2;
  } elseif ($op === "subtract") {
    $result = $n1 - $n2;
  }

  echo "<h2>Calculation Result: $result</h2>";
  echo "<a href='index.php'>Go Back</a>";
}
?>