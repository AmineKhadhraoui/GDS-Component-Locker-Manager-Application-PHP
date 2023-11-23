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
<div style=" width: 80%;
    max-width: 600px;
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
            margin-bottom: 20px;">Component Return</h2>

            <div style=" margin-bottom: 20px;  
            ">
    <div class="form-group" >
      <label  for="NI"  style=" display: block;
  font-weight: bold;
  margin-bottom: 10px;">NI :</label>
      <input  type="text" id="NI" name="NI" required   style=" width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
  box-sizing: border-box;
  margin-bottom: 10px;">
  <label  for="retour" style=" display: block;
  font-weight: bold;
  margin-bottom: 10px;">Quantity to return:</label>
      <input  type="text" id="retour" name="retour" required   style=" width: 100%;
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
  margin: 0 auto;">Return</button>
    </div>
  </form>
</div>
</div></div>
<?php include '../footer.php'; ?>
	<?php
// Start the session (if not already started)



// Check if the user is logged in or if you need to handle authentication

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user = $_SESSION['username'];
    $NI = $_POST['NI'];
    $retour = $_POST['retour'];
    $return_date = date('Y-m-d H:i:s');

    // Prepare the SQL query for selecting data from uncharging_repport
    $selectQuery = "SELECT id_cas, codice, id_case, emp_case FROM uncharging_repport WHERE NI = ?";

    // Prepare the statement for SELECT
    $stmt = $conn->prepare($selectQuery);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo "Error in preparing the SELECT statement: " . $conn->error;
        exit;
    }

    // Bind the NI parameter
    $stmt->bind_param("s", $NI);

    // Execute the SELECT prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Retrieve the selected data and insert into retour
        while ($row = $result->fetch_assoc()) {
            $selected_id_cas = $row['id_cas'];
            $selected_id_case = $row['id_case'];
            $selected_emp_case = $row['emp_case'];
            $selected_codice = $row['codice'];

            // Prepare the SQL query for insertion
            $insertQuery = "INSERT INTO retour (username, NI, qte_retour, id_cas, id_case, emp_case, codice) 
                            VALUES (?,?,?,?,?,?,?)";

            // Prepare the statement for insertion
            $insertStmt = $conn->prepare($insertQuery);

            // Check if the statement was prepared successfully
            if ($insertStmt === false) {
                echo "Error in preparing the INSERT statement: " . $conn->error;
                exit;
            }

            // Bind parameters to the prepared statement for insertion
            $insertStmt->bind_param("sssssss", $user, $NI, $retour, $selected_id_cas, $selected_id_case, $selected_emp_case, $selected_codice);

            // Execute the insertion query
            if ($insertStmt->execute()) {
                echo '<script>alert("Component returned successfully");</script>';
            } else {
                echo '<script>alert("Error inserting data: ' . $insertStmt->error . '");</script>';
            }

            // Close the insert statement
            $insertStmt->close();
        }
    } else {
        echo '<script>alert("No data found for the given NI.");</script>';
    }

    // Close the select statement
    $stmt->close();
}

// Close the database connection

?>
