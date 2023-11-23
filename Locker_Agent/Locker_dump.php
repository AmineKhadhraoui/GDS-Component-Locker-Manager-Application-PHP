<?php include '../config.php'; ?>

<?php include '../header.php'; ?>
<a href="Locker_Agent_interface.php"
	style="position: fixed; left: 20px;Top:80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
	<i style="margin-right: 8px;">&larr;</i> Go Back
</a>
<br<br><br><br><br><br><br>
<div class="background-container"> 
<div  style=" font-family: Arial, sans-serif;
    
    display: flex;
    align-items: center;
    justify-content: center;
 
    ">
<div style=" width: 50%;
    max-width: 400px;
    margin: 0 auto;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
border-radius: 4px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(8px);
}">
<form method="POST" >
    <h2  style="text-align: center;
            font-size: 24px;
            margin-bottom: 20px;">Locker Dumping</h2>

      <label  for="NI"  style=" display: block;
  font-weight: bold;
  margin-bottom: 10px;">NI :</label>
      <input  type="text" id="NI" name="NI" required   style=" width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  margin-bottom: 10px;">
      <button   type="submit" name="submit"   style="background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: block;
  margin: 0 auto;">Dumping</button>
  </form></div></div></div>



  <?php include '../footer.php'; ?>

  
	<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user = $_SESSION['username'];
    $NI = $_POST['NI'];
    $dump_date = date('Y-m-d H:i:s');

    // Prepare the SQL query for selecting data from charging_report
    $selectQuery = "SELECT id_cas, codice, id_case, emp_case, qte_charg FROM charging_report WHERE NI = ?";

    // Prepare the statement
    $stmt = $conn->prepare($selectQuery);

    // Bind the NI parameter
    $stmt->bind_param("s", $NI);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Retrieve the selected data and insert into uncharging_repport
        while ($row = $result->fetch_assoc()) {
            $selected_id_cas = $row['id_cas'];
            $selected_id_case = $row['id_case'];
            $selected_emp_case = $row['emp_case'];
            $selected_codice = $row['codice'];
            $selected_qte_dump = $row['qte_charg'];

            // Prepare the SQL query for insertion into uncharging_repport
            $insertQuery2 = "INSERT INTO uncharging_repport (username, id_cas, id_case, emp_case, NI, codice, qte_dump) 
			VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Prepare the statement for insertion
            $stmt2 = $conn->prepare($insertQuery2);

            // Bind the parameters for insertion
            $stmt2->bind_param("sssssss", $user, $selected_id_cas, $selected_id_case, $selected_emp_case, $NI, $selected_codice, $selected_qte_dump);

            // Execute the prepared statement for insertion
            if ($stmt2->execute()) {
                echo '<script>alert("Component dumped successfully");</script>';
            } else {
                echo '<script>alert("Error inserting data: ' . $stmt2->error . '");</script>';
            }

            // Close the second prepared statement
            $stmt2->close();
        }
    } else {
        echo '<script>alert("No data found in charging_report for the given NI.");</script>';
    }

    // Close the first prepared statement
    $stmt->close();
} else {
   // echo '<script>alert("Error: No data submitted.");</script>';
}


?>
