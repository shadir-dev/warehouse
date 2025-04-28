<?php
// Show errors for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$db   = 'warehouse_db'; // ✅ Replace with your DB name
$user = 'root';               // ✅ Replace with your DB username
$pass = '';                   // ✅ Replace with your DB password ('' for XAMPP)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);

    // Fetch data
    $stmt = $conn->query("SELECT * FROM stock");
    $stocks = $stmt->fetchAll();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($stocks);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>