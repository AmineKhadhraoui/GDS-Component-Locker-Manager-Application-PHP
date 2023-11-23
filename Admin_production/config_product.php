<?php include '../config.php' ?>

<?php include '../header.php'; ?>



<?php


if (isset($_GET['name'])) {
	$product_name = $_GET['name'];

	// Fetch components for the selected product name
	$query = "SELECT id_component, Codice, Machine, Table_machine, Emplacement FROM component WHERE Product_name = '$product_name'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		// Check if there are any components
		if (mysqli_num_rows($result) > 0) {
			echo '<a href="Products_list.php" style="position: fixed; left: 20px;top :80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
			<i style="margin-right: 8px;">&larr;</i> Go Back
		  </a>
			<center><h1 style="font-size: 28px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px; text-transform: uppercase;">Components for ' . $product_name . '</h1></center>';
			echo '<table style="width: 100%; border-collapse: collapse; background-color: rgba(255, 255, 255, 0.7); border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); backdrop-filter: blur(8px);">';
			echo '<tr>';
			echo '<th style="padding: 8px; text-align: left; background-color: #f2f2f2; border-bottom: 1px solid #ddd;">Component Codice</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Machine</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Table</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Emplacement</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>';
			echo '</tr>';

			// Loop through each row of the result
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Codice'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Machine'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Table_machine'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Emplacement'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">';
				echo '<a href="edit_component.php?id_component=' . $row['id_component'] . '"><i class="material-icons text-primary" style="color:#007FFF; margin-right:10px;">edit</i></a>'; // Edit link
				echo '<a href="delete_component.php?id_component=' . $row['id_component'] . '&name=' . urlencode($product_name) . '"><i class="material-icons text-danger" style="color:#EF0107">delete</i></a>';


				echo '</td>';
				echo '</tr>';
			}

			echo '</table> <a href="add_component.php?name=' . $product_name . '" style="display: inline-block; background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; text-align: center; text-decoration: none; font-size: 16px; cursor: pointer;"><i class="fas fa-plus" style="margin-right: 5px;"></i> Add component</a>';

		} else {
			echo 'No components found for ' . $product_name;
			echo '<br><br><br>';
			echo '</table> <a href="add_component.php?name=' . $product_name . '" style="display: inline-block; background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 20px; text-align: center; text-decoration: none; font-size: 16px; cursor: pointer;"><i class="fas fa-plus" style="margin-right: 5px;"></i> Add component</a>';

		}
	} else {
		echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
	}
} else {
	// echo '<script>alert("Invalid request");</script>';
}

// Close the database connection
mysqli_close($conn);
?>

<?php include '../footer.php'; ?>