<?php include '../config.php' ?>

<?php include '../header.php'; ?>

<?php


if (isset($_GET['id_component'])) {
    $id_component = $_GET['id_component'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_component = $_POST["id_component"];
    $product_name = $_POST["product_name"];
    $machine = $_POST["machine"];
    $table_machine = $_POST["table_machine"];
    $emplacement = $_POST["emplacement"];

    // Prepare the SQL statement to update the component details
    $stmt = $conn->prepare("UPDATE component SET Product_name = ?, Machine = ?, Table_machine = ?, Emplacement = ? WHERE id_component = ?");
    $stmt->bind_param("ssssi", $product_name, $machine, $table_machine, $emplacement, $id_component);

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo '<script>alert("Component updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating component: ' . $stmt->error . '");</script>';
    }

    // Close the prepared statement
    $stmt->close();
}


    // Fetch the component details based on the 'codice'
    $query = "SELECT * FROM component WHERE id_component = '$id_component'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $component = mysqli_fetch_assoc($result);
        ?>
        <a href="Products_list.php" style="position: fixed; left: 20px; top: 80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
            <i style="margin-right: 8px;">&larr;</i> Go Back
        </a>
		<br><br><br><br>
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
        <h2  style="text-align: center;
            font-size: 24px;
            margin-bottom: 20px;">Edit Component <?php echo $component['Codice']; ?></h2>
        <form method="POST">
            <input type="hidden" name="codice" value="<?php echo $component['Codice']; ?>">
           
            <input type="hidden" name="product_name"  value="<?php echo $component['Product_name']; ?>"><br>
			 <input type="hidden" name="id_component" value="<?php echo $id_component; ?>">

        <div style="margin-bottom: 20px;">
  <label for="machine" style="display: block; font-weight: bold; margin-bottom: 5px;">Machine:</label>
  <select id="machine" name="machine" style="width: 100%; height:40px; padding: 10px; border-radius: 3px; border: 1px solid #ccc; font-size: 16px;">
    <option value="">Select a machine</option>
    <option value="F5" <?php if ($component['Machine'] === 'F5') echo 'selected'; ?>>F5</option>
    <option value="H60" <?php if ($component['Machine'] === 'H60') echo 'selected'; ?>>H60</option>
  </select>
</div>
<div style="margin-bottom: 20px;">
  <label for="table_machine" style="display: block; font-weight: bold; margin-bottom: 5px;">Table Machine:</label>
  <select id="table_machine" name="table_machine" style="width: 100%; height:40px; padding: 10px; border-radius: 3px; border: 1px solid #ccc; font-size: 16px;">
    <option value="">Select a Table</option>
    <option value="1" <?php if ($component['Table_Machine'] === '1') echo 'selected'; ?>>1</option>
    <option value="2" <?php if ($component['Table_Machine'] === '2') echo 'selected'; ?>>2</option>
    <option value="3" <?php if ($component['Table_Machine'] === '3') echo 'selected'; ?>>3</option>
    <option value="4" <?php if ($component['Table_Machine'] === '4') echo 'selected'; ?>>4</option>
  </select>
</div>
<div style="margin-bottom: 20px;">
  <label for="emplacement" style="display: block;  font-weight: bold; margin-bottom: 5px;">Emplacement:</label>
  <select id="emplacement" name="emplacement" style="width: 100%; height:40px; padding: 10px; border-radius: 3px; border: 1px solid #ccc; font-size: 16px; overflow-y: auto; max-height: 150px;">
    <option value="">Select a number</option>
    <?php
for ($i = 1; $i <= 116; $i++) {
    for ($j = 1; $j <= 3; $j++) {
        $val = $i . '-' . $j;
        echo "<option value='$val'>$val</option>";
    }
}
?>

  </select>
</div>


            <button type="submit"   style=" display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;">Update Component</button>
        </form>
    </div>
    </div>

        <?php
    } else {
        echo 'Component not found.';
    }
} 

// Close the database connection
mysqli_close($conn);
?>

<?php include '../footer.php'; ?>