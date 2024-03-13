<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "loc";   

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 for proper data handling
$conn->set_charset("utf8");
?>
