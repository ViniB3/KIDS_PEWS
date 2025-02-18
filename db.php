<?php
// Database connection credentials
$host = 'localhost';      // MySQL server (usually localhost)
$username = 'root';       // Your MySQL username
$password = 'root';           // Your MySQL password (default is empty for local server)
$dbname = 'PEWS';  // The database name

// Create connection using mysqli
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
