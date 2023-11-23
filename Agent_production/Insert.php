
<?php
include '../config.php';
// Retrieve the component codice from the URL parameter
$componentCodice = $_GET['codice'];
$id=$_GET['id'];

// Fetch the component details from the database
$query = "SELECT * FROM component WHERE Codice = '$componentCodice' and id_component='$id'";
$result = mysqli_query($conn, $query);

if ($result) {
	// Check if the component exists
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$id=$row['id_component'];
		// Retrieve the product name from the component details
		$productName = $row['Product_name'];

		// Check if the form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Retrieve the form data
			$machine = $_POST['machine'];
			$table = $_POST['table'];
			$emplacement = $_POST['emplacement'];
			$agentName = $_SESSION['username'];
			$ni = $_POST['ni'];
			$feder = $_POST['feder'];
			$changedFeder = $_POST['changed_feder'];
			$newNi = $_POST['new_ni'];
			
			

			// Compare the form data with the component details
			if (
				$row['Machine'] == $machine &&
				$row['Table_Machine'] == $table &&
				$row['Emplacement'] == $emplacement
			) {
				// Component details are correct

				/* Check if the inserted Ni matches the Ni from the charging_report table
				$chargingQuery = "SELECT Ni FROM charging_report WHERE Codice = '$componentCodice' AND Ni = '$ni'";
				$chargingResult = mysqli_query($conn, $chargingQuery);

				if ($chargingResult && mysqli_num_rows($chargingResult) > 0) {
					// Ni matches, continue with the testing process*/

					
					// Insert the form data into the testing_report table
					$insertQuery = "INSERT INTO testing_report (Agent_name, Ni, Codice, Machine, Table_machine, Emplacement, Feder, Changed_feder, New_Ni) 
                                    VALUES ('$agentName', '$ni', '$componentCodice', '$machine', '$table', '$emplacement', '$feder', '$changedFeder', '$newNi')";
					$insert = "INSERT INTO `component_verification`(`component_ni`, `codice`,`id_component`) VALUES ('$ni','$componentCodice','$id')";
					$insertResult = mysqli_query($conn, $insertQuery);
					$insertResult1 = mysqli_query($conn, $insert);

					if ($insertResult) {
						// Insertion successful
						// Update the component verification status

						// Verification successful
						// Redirect back to the previous page with a success message
						$successMessage = "Verification successful.";
						echo "<script>alert('$successMessage'); window.location.href='Testing_component.php?step=2&name=" . urlencode($productName) . "';</script>";
						exit();
					} else {
						// Error occurred while inserting data into the testing_report table
						$errorInsertingMessage = "Error inserting data into testing_report: " . mysqli_error($conn);
						echo "<script>alert('$errorInsertingMessage');</script>";
					}
				/*} else {
					// Ni does not match
					$invalidNiMessage = "Invalid Ni. Please try again.";
					echo "<script>alert('$invalidNiMessage'); window.location.href='Testing_component.php?step=2&name=" . urlencode($productName) . "';</script>";
				}*/
			} else {
				// Component details are incorrect
				$incorrectDetailsMessage = "Incorrect component details. Please try again.";
				echo "<script>alert('$incorrectDetailsMessage'); window.location.href='Testing_component.php?step=2&name=" . urlencode($productName) . "';</script>";
			}
		}
	} else {
		// Component not found
		echo "Component not found.";
	}
} else {
	// Error occurred while fetching component details
	echo "Error fetching component details: " . mysqli_error($conn);
}

// Close the database connection
$conn->close();
?>