<?php include '../config.php'?>

<?php include '../header.php'; ?>

<?php

// Reset All Button
if (isset($_POST['reset_all'])) {
    $deleteQuery = "DELETE FROM component_verification";

    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("All records deleted successfully.");</script>';
    } else {
        echo '<script>alert("Error deleting records: ' . $conn->error . '");</script>';
    }
}


// Step 1: Product Name
if (!isset($_GET['step']) || $_GET['step'] === '1') {
	echo '<center>  <h1  style="font-size: 24px;
	margin-bottom: 20px;
	text-transform: uppercase;">Step 1: Product Name</h1>';

	// Query the database to fetch product names
	$sql = "SELECT name FROM product";
	$result = $conn->query($sql);

	if ($result) {
		// Check if any products are found
		if ($result->num_rows > 0) {
			echo ' <center>  <form method="GET" action="Testing_component.php"   style=" margin: 50px auto;
			max-width: 500px;
			padding: 20px;
			background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
			border-radius: 4px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			backdrop-filter: blur(8px); 
			">';
			echo '<label for="product_name"  style="font-size: 16px;
			margin-bottom: 10px; ">Product Name:</label>';
			echo '<select id="product_name" name="name"  style=" width: 400px; /* Updated width */
			border: 1px solid #ccc;
		   border-radius: 4px;
		   margin-bottom: 20px;
		   overflow-y: auto;
			   max-height: 150px;">';

			// Output each product as an option in the select element
			while ($row = $result->fetch_assoc()) {
				$productName = $row['name'];
				echo "<option value='$productName'>$productName</option>";
			}

			echo '</select>';
			echo '<input type="hidden" name="step" value="2">';
			echo '<button type="submit"  style=" padding: 10px 20px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;">Next</button>';
			echo '</form>';
		} else {
			echo '<p  style="color: red;
			margin-top: -10px;
			margin-bottom: 20px;">No products found.</p>';
		}
	} else {
		echo '<p  style="color: red;
		margin-top: -10px;
		margin-bottom: 20px;"> Error fetching products: </p>' . mysqli_error($conn);
	}
}

// Step 2: Component Listing
if (isset($_GET['step']) && $_GET['step'] === '2' && isset($_GET['name'])) {
	$product_name = $_GET['name'];

	// Fetch components for the selected product name
	$query = "SELECT  c.Codice, c.Machine, c.Table_machine, c.Emplacement , t.component_ni ,c.id_component FROM component c LEFT JOIN component_verification t on c.Codice=t.codice WHERE Product_name = '$product_name' GROUP BY c.id_component";
	$result = mysqli_query($conn, $query);

	if ($result) {
		// Check if there are any components
		if (mysqli_num_rows($result) > 0) {
			echo '<a href="Testing_component.php" style="position: fixed; left: 20px; top: 80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
			<i style="margin-right: 8px;">&larr;</i> Go Back
			</a>
			<h1  style=" font-size: 28px;
			font-weight: bold;
			color: #333;
			text-align: center;
			margin-bottom: 20px;
			text-transform: uppercase;">Components for ' . $product_name . '</h1>';
			echo '<table style="  width: 100%;
			border-collapse: collapse;
			background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
			border-radius: 4px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			backdrop-filter: blur(8px);
		  ">';
			echo '<tr>';
			
			echo '<th  style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Component Codice</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Machine</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Table</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Emplacement</th>';
			//echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Ni</th>';
			echo '<th style="padding: 8px; background-color: #f2f2f2; text-align: left; border-bottom: 1px solid #ddd;">Verification</th>';



			echo '</tr>';

			// Loop through each row of the result
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
			
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Codice'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Machine'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Table_machine'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">' . $row['Emplacement'] . '</td>';
				echo '<td style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">';
				$verificationQuery = "SELECT  A.id_component FROM component_verification A ,component B WHERE A.codice = '" . $row['Codice'] . "' AND  A.id_component = '". $row['id_component']."'";
				$verificationResult = mysqli_query($conn, $verificationQuery);

				$Ni = $row['component_ni'];
				$id = $row['id_component'];
				$componentCodice = $row['Codice'] ;

				if ($verificationResult) {
					// Check if there are any rows returned from the query
					if (mysqli_num_rows($verificationResult) > 0) {
						$verificationData = mysqli_fetch_assoc($verificationResult);
							// Component is verified
							echo '<button type="button" class="btn btn-success btn-sm inline-button">Verified</button>';

							// Reset record button
							echo '<form method="POST" action="" class="inline-form">';
							echo '<input type="hidden" name="reset_component_ni" value="' . $Ni . '">';
							echo '<button type="submit" name="reset_ni" class="btn btn-warning btn-sm inline-button">Reset</button>';
							echo '</form>';
					} else {
						// Component is not verified
						echo '<a href="Verify_component.php?codice=' . urlencode($componentCodice) . '&id=' . urlencode($id) . '"><button type="button" class="btn btn-danger btn-sm">Verify</button></a>';

					}
					echo '</td>';
					echo '</tr>';
				}
			}
			if (isset($_POST['reset_ni'])) {
			$resetComponentCodice = $_POST['reset_component_ni'];

    // Change the UPDATE query to DELETE query
				$deleteQuery = "DELETE FROM component_verification WHERE component_ni = '$resetComponentCodice'";

			if ($conn->query($deleteQuery) === TRUE) {
				echo '<script>alert("Record deleted successfully for component code ' . $resetComponentCodice . '");</script>';
				echo '<script>window.location.href = "Testing_component.php?step=2&name=' . $_GET['name'] . '";</script>';
				exit;
			} else {
				echo '<script>alert("Error deleting record: ' . $conn->error . '");</script>';
					}
			}

			echo '</table>';
			echo '<form method="POST" action="Testing_component.php">';
			echo '<button type="submit" name="reset_all" style="background-color: #f44336; color: #ffffff; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px; cursor: pointer;"
       onmouseover="this.style.backgroundColor=\'#d32f2f\';" onmouseout="this.style.backgroundColor=\'#f44336\';">Reset All</button>';

			echo '</form>';


		} else {
			echo 'No components found for ' . $product_name;
			echo '<br><br><br>';
		}
	} else {
		echo 'Error fetching components: ' . mysqli_error($conn);
	}
}

// Close the database connection
$conn->close();
?>




<?php include '../footer.php'; ?>