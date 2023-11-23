<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "CLM"; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $product_name = $_POST["name"];

    $codice = $_POST["codice"];
    $machine = $_POST["machine"];
    $table_machine = $_POST["table_machine"];
    $emplacement = $_POST["emplacement"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO component (Codice, Product_name, Machine, Table_machine, Emplacement) VALUES (?, ?, ?, ?, ?)");

    // Bind the parameters to the SQL statement
    $stmt->bind_param("sssss", $codice, $product_name, $machine, $table_machine, $emplacement);

    // Execute the SQL statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect back to config_product.php with the product name in the URL
        
        header("Location: config_product.php?name=" . urlencode($product_name));
        exit(); // Make sure to exit after the redirect
    } else {
        echo '<script>alert("Error adding component: ' . $stmt->error . '");</script>';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>