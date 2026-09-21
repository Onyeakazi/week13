<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>day1</title>
</head>
<body>
    
    <?php 
    
        $tech = "php";
        $name = "IONS";

        // echo 'my name is $name' . "<br>";

        $colors = ["Red", "Green", "Blue"];
        $colors[] = "Yellow"; // Append an element
        
        // 2. Associative Array
        $user = [
            "username" => "admin_alex",
            "role" => "Admin"
        ];
        
        // 3. Essential Array Utilities
        $total = count($colors); // Returns: 4
        $is_red_present = in_array("Red", $colors); // Returns: true

        // $input = $_POST['username'] ?? 'john'; // Null coalescing operator fallback

        if (isset($input) && !empty($input)) {
            echo "Username is provided." . "<br>";
        }else{
            echo "Username is not provided" . "<br>";
        }
        
        // Inspecting structures during debugging:
        // var_dump($colors); 

        function calculateTotal($price, $taxRate = 0.05) {
            $total = $price + ($price * $taxRate);
            return $total;
        }
        
        $bill = calculateTotal(100); // Returns 105
        echo "<p>Your total bill is $$bill</p>";
    
    ?>
    <h1>today we are learning <?php echo $tech ?></h1>
    <h1>today we are learning <?= $tech ?></h1>

    <form action="process_calc.php" method="POST">
        <label>Number 1:</label>
        <input type="number" name="num1" required>
        
        <label>Operation:</label>
        <select name="operation">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
        </select>
        
        <label>Number 2:</label>
        <input type="number" name="num2" required>
        
        <button type="submit">Calculate</button>
    </form>
</body>
</html>