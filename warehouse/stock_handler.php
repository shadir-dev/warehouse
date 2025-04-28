<?php

$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "warehouse_db"; // Database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemType = $_POST['itemType'];
    $itemName = $_POST['itemName'];
    $quantity = $_POST['quantity'];
    $location = $_POST['location'];

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO stock (item_type, item_name, quantity, location) VALUES (:itemType, :itemName, :quantity, :location)");
    $stmt->bindParam(':itemType', $itemType);
    $stmt->bindParam(':itemName', $itemName);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':location', $location);

    if ($stmt->execute()) {
        echo "Stock saved successfully!";
    } else {
        echo "Error saving stock.";
    }
}
?>
