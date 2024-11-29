<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'class_notes';
$username = 'av890'; // Change this to your database username
$password = 'alu890'; // Change this to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Create users table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
$pdo->exec($sql);

// Create default user if it doesn't exist
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => 'av7890']);
if ($stmt->rowCount() == 0) {
    $hashed_password = password_hash('alu5900', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => 'av7890', 'password' => $hashed_password]);
}
?>