<?php include '../config.php'; ?>

<?php include '../header.php'; ?>


<div class="background-container">
 <br> <br> 
<div  style=" font-family: Arial, sans-serif;
    
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh; 
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
            margin-bottom: 20px;">Locker Charging</h2>

            <div style=" margin-bottom: 20px;  
            ">
    <label style=" display: block;
            font-weight: bold;
            margin-bottom: 5px;" for="casier">Locker:</label>
    <input style="  width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;" type="text" id="id_casier" name="id_casier" required>
            </div>
            <div style=" margin-bottom: 20px;  
            ">
    <label style=" display: block;
            font-weight: bold;
            margin-bottom: 5px;" for="case">Locker Case:</label>
    <input style="  width: 100%;
            padding: 10px;
            border-radius: 3px;

            border: 1px solid #ccc;
            font-size: 16px;" type="text" id="locker_case" name="locker_case" required>
   </div>
   <div style=" margin-bottom: 20px;  
            ">
    <label style=" display: block;
            font-weight: bold;
            margin-bottom: 5px;" for="codice"> Case emplacement:</label>
    <select id="emp" name="emp" style="  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 20px;
  font-size: 16px;
  height:50px;
  overflow-y: auto;
      
  width: 100%;">
      <option value="Line 1">Line 1</option>
      <option value="Line 2">Line 2</option>
      <option value="Line 3">Line 3</option>
    </select>
    </div>
    <div style=" margin-bottom: 5px;  ">
    <label style=" display: block;
            font-weight: bold;
            margin-bottom: 0px;" for="composant1_Ni">Ni :</label>
        <input style="  width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;" type="text" id="Ni" name="Ni" required>
</div><div style=" margin-bottom: 20px;  
            ">
        <label style=" display: block;
            font-weight: bold;
            margin-bottom: 5px;" for="composant1_nom">Codice component:</label>
        <input style="  width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;" type="text" id="codice" name="codice" required>
</div><div style=" margin-bottom: 20px;  
            ">
        <label style=" display: block;
            font-weight: bold;
            margin-bottom: 5px;" for="composant1_quantite">Quantity:</label>
        <input style="  width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;" type="number" id="qte" name="qte" required>
   
    </div>
    <a href="charging_report.php"><button style=" display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;" type="submit" name="submit">Add Component</button>
</form>

</div></div></div>
    
<?php include '../footer.php'; ?>
  
<?php



if (isset($_POST['submit'])) {
  // Retrieve form data
  $user = $_SESSION['username'];
  $charg_date = date('Y-m-d H:i:s');
  $Loc_code = $_POST['id_casier'];
  $Loc_case = $_POST['locker_case'];
  $emplace = $_POST['emp'];
  $Ni = $_POST['Ni'];
  $codice = $_POST['codice'];
  $qte = $_POST['qte'];

  // Prepare the SQL query for insertion
  $insertQuery = "INSERT INTO charging_report (username, id_cas, id_case, emp_case,Ni, codice, qte_charg) 
  VALUES ('$user', '$Loc_code', '$Loc_case','$emplace', '$Ni', '$codice', '$qte')";

  // Execute the insertion query
  if ($conn->query($insertQuery) === TRUE) {
	echo '<script>alert("Charging Report Created successfully.");</script>';
      // Prepare the SQL query for update
       /* $updateQuery = "UPDATE locker_case1
                      JOIN charging_report ON locker_case1.codice = charging_report.codice
                      SET locker_case1.qte = locker_case1.qte + charging_report.qte_charg
					  where locker_case1.NI = charging_report.NI ";  
      
      // Execute the update query
      if ($connection->query($updateQuery) === TRUE) {
          echo '<script>alert("Component charged successfully.");</script>';
      } else {
          echo '<script>alert("Error: ' . $updateQuery . '\\n' . $connection->error . '");</script>';
      }*/
  } else {
      echo '<script>alert("Error: ' . $insertQuery . '\\n' . $conn->error . '");</script>';
  }
}



?>
 