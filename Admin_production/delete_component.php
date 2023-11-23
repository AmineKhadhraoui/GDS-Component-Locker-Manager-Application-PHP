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

if (isset($_GET['id_component'])) {
    $id_component = $_GET['id_component'];

    // Prepare the SQL statement to delete the component
    $stmt = $conn->prepare("DELETE FROM component WHERE id_component = ?");
    $stmt->bind_param("i", $id_component);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect back to config_product.php with the product name in the URL
        header("Location: config_product.php?name=" . urlencode($_GET['name']));
        exit(); // Make sure to exit after the redirect
    } else {
        echo '<script>alert("Error deleting component: ' . $stmt->error . '");</script>';
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo '<script>alert("Invalid request");</script>';
}

// Close the database connection
$conn->close();
?>
