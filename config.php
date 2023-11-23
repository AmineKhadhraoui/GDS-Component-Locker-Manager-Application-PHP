<?php
session_start();
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = "";
$dbname = "CLM";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>