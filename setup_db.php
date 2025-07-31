<?php
// Database initialization script
$servername = "localhost";
$username = "root";
$password = "";

// Create connection without selecting database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS final";
if ($conn->query($sql) === TRUE) {
    echo "Database 'final' created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("final");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS string_info (
    string_id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'string_info' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
echo "<br>Database setup complete! You can now use the application.";
echo '<br><a href="index.php">Go to Main Page</a>';
?>
