<?php include '../config.php' ?>
<?php

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
	$product_id = $_GET['id'];

	// Retrieve the product information from the database
	$query = "SELECT * FROM product WHERE Product_id = '$product_id'";
	$result = mysqli_query($conn, $query);

	// Check if the product exists
	if (mysqli_num_rows($result) > 0) {
		$product = mysqli_fetch_assoc($result);

		// Check if the form is submitted for updating the product
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$description = $_POST['description'];


			// Update the product in the database
			$updateQuery = "UPDATE product SET Name = '$name', Description = '$description' WHERE Product_id = '$product_id'";
			$updateResult = mysqli_query($conn, $updateQuery);

			if ($updateResult) {
				echo '<script>alert("Product updated successfully.");</script>';
				// Refresh the product details after update
				$product['Name'] = $name;
				$product['Description'] = $description;
				header("Location: Products_list.php");
				exit();
			} else {
				echo '<script>alert("Error updating product: ' . mysqli_error($conn) . '");</script>';
			}

		}
		?>


		<?php include '../header.php'; ?>









		<br><br>
<a href="Products_list.php" style="position: fixed; left: 20px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
    <i style="margin-right: 8px;">&larr;</i> Go Back
  </a>









		<BR><BR><BR>
		<div style=" max-width: 800px;text-align: center;
width:500px;
height:400px;
		margin: 0 auto;
		padding: 20px;
		background-color: #f7f7f7;
		border-radius: 5px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8px); ">
			<h2>Modify Product</h2>
			<form method="POST" action="">
				<input type="hidden" name="product_id" value="<?php echo $product['Product_id']; ?>"><br>

				<label for="name" style="display: block;text-align: left;
		margin-bottom: 5px;">Name:</label>
				<input type="text" name="name" value="<?php echo $product['Name']; ?>" required style="width: 100%;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-bottom: 10px;"> <br><br>

				<label for="description" style="display: block;text-align: left;
		margin-bottom: 5px;">Description:</label>
				<textarea name="description" style="width: 100%;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-bottom: 10px;" required><?php echo $product['Description']; ?></textarea><br>


				<br>
				<input type="submit" name="submit" value="Update" style=" background-color: #4CAF50;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;">
			</form>
		</div>



		<?php
	} else {
		echo '<script>alert("Product not found.");</script>';
	}
} else {
	echo '<script>alert("Product ID not provided.");</script>';
}

// Close the database connection
mysqli_close($conn);
?>




<?php include '../footer.php'; ?>