<?php include '../config.php' ?>

<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $productId = $_POST['product-id'];
    $productName = $_POST['product-name'];
    $productDescription = $_POST['product-description'];

    // Get the current date and time
    $creationDate = date('Y-m-d H:i:s');

    // Prepare the insert statement
    $sql = "INSERT INTO product (Product_id, Name, Description, Creation_date)
            VALUES ('$productId', '$productName', '$productDescription', '$creationDate')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Product created successfully.");</script>';
		header("Location: Products_list.php");
        exit();
		
    } else {
        echo '<script>alert("Error: ' . $sql . '\\n' . $conn->error . '");</script>';
    }
}

// Close the database connection
$conn->close();
?>

<?php include '../header.php'; ?>


<br><br>
<a href="Products_list.php" style="position: fixed; left: 20px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
    <i style="margin-right: 8px;">&larr;</i> Go Back
  </a>
    



<div class="background-container">
	<br><br>
<div style=" display: flex;
  justify-content: center;
  align-items: center;

 ">
<div style="width: 500px;
  padding: 30px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8px); ">
    <h1 style=" text-align: center;">Create Product</h1>
    <form method="POST" class="product-form"  >
        <div style=" margin-bottom: 20px;">
            <label for="product-id" style=" display: block;
  font-weight: bold;
  margin-bottom: 5px;">Product ID:</label>
            <input type="text" id="product-id" name="product-id" required style=" width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;">
        </div>
        <div class="form-group">
            <label for="product-name" style=" display: block;
  font-weight: bold;
  margin-bottom: 5px;">Name:</label>
            <input type="text" id="product-name" name="product-name" required style=" width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;">
        </div>
        <div class="form-group">
            <label for="product-description" style=" display: block;
  font-weight: bold;
  margin-bottom: 5px;">Description:</label>
            <textarea id="product-description" name="product-description" required style=" width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;"></textarea>
        </div><br>
        <button type="submit" name="submit" style=" display: block;
  margin: 0 auto;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;">Create</button>
    </form>
</div>
</div>
</div>


<?php include '../footer.php'; ?>