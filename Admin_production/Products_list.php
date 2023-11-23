<?php include '../config.php' ?>

<?php include '../header.php'; ?>

<?php

if (isset($_GET['disable'])) {
	$product_id = $_GET['disable'];

	// Update the product status as disabled
	$disableQuery = "UPDATE product SET Status = 'Disabled' WHERE Product_id = '$product_id'";
	$disableResult = mysqli_query($conn, $disableQuery);

	if ($disableResult) {
		echo '<script>alert("Product disabled successfully.");</script>';
		// Refresh the page after disabling the product
		echo '<script>window.location.href = "Products_list.php";</script>';
		exit;
	} else {
		echo '<script>alert("Error disabling product: ' . mysqli_error($conn) . '");</script>';
	}
}

if (isset($_GET['enable'])) {
	$product_id = $_GET['enable'];

	// Update the product status as enabled
	$enableQuery = "UPDATE product SET Status = 'Enabled' WHERE Product_id = '$product_id'";
	$enableResult = mysqli_query($conn, $enableQuery);

	if ($enableResult) {
		echo '<script>alert("Product enabled successfully.");</script>';
		// Refresh the page after enabling the product
		echo '<script>window.location.href = "Products_list.php";</script>';
		exit;
	} else {
		echo '<script>alert("Error enabling product: ' . mysqli_error($conn) . '");</script>';
	}
}

// Retrieve data from the "product" table
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
	echo '<a href="Admin_production_interface.php" style="position: fixed; left: 20px; top: 80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
	<i style="margin-right: 8px;">&larr;</i> Go Back
</a>
	
	<h1 style="font-size: 28px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px; text-transform: uppercase;">Products List</h1>';
	echo '<table style="width: 100%; border-collapse: collapse; background-color: rgba(255, 255, 255, 0.7); border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); backdrop-filter: blur(8px);">';
	echo '<tr>';
	echo '<th style="padding: 8px; text-align: left; background-color: #f2f2f2; border-bottom: 1px solid #ddd;">Product ID</th>';
	echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Name</th>';
	echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Description</th>';
	echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Creation Date</th>';
	echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>';
	echo '</tr>';

	// Loop through each row of the result
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<tr>';
		echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Product_id'] . '</td>';
		echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Name'] . '</td>';
		echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Description'] . '</td>';
		echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Creation_date'] . '</td>';
		echo '<td style="padding: 8px; display: flex; gap: 11px; text-align: left; border-bottom: 1px solid #ddd;">';

		if ($row['Status'] === 'Enabled') {
			echo '<a href="modify_product.php?id=' . $row['Product_id'] . '"><i class="material-icons text-primary" style="color:#007FFF;">edit</i></a>';
			echo '<a href="config_product.php?name=' . urlencode($row['Name']) . '"><i class="material-icons text-success" style="color: gray;">settings</i></a>';
			echo '<a href="?disable=' . $row['Product_id'] . '"><i class="material-icons text-danger" style="color:#EF0107">block</i></a>';
		} else {
			echo '<span>Disabled</span>';
			echo '<a href="?enable=' . $row['Product_id'] . '"><i class="material-icons text-success" style="color: green;">check</i></a>';
		}

		echo '</td>';
		echo '</tr>';
	}

	echo '</table>
    <button type="button" style="display: inline-block; background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; text-align: center; text-decoration: none; font-size: 16px; cursor: pointer;">
        <i class="fas fa-plus" style="margin-right: 5px;"></i> <a href="creation_product.php" style="color: white; text-decoration: none;">Add Product</a>
    </button>';
} else {
	echo 'No records found.';
	echo '<br> <button type="button" style="display: inline-block; background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; text-align: center; text-decoration: none; font-size: 16px; cursor: pointer;">
        <i class="fas fa-plus" style="margin-right: 5px;"></i> <a href="creation_product.php" style="color: white; text-decoration: none;">Add Product</a>
    </button>';
}

// Close the database connection
mysqli_close($conn);
?>


<?php include '../footer.php'; ?>