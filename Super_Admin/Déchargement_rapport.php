<?php include '../config.php';?>

<?php include '../header.php'; ?>
<a href="Reports.php" style="position: fixed; right: 20px; top: 80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
	<i style="margin-right: 8px;">&larr;</i> Go Back
</a>
<br>
<div class="filter-form" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
  <form method="GET" style="flex: 1; margin-right: 10px; display: flex;">
    <label for="date-filter" style="font-weight: bold; display: block; margin-bottom: 10px;">Filter by Date:</label>
    <input type="date" name="date" id="date-filter" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box; width: 200px; margin-right: 10px;">

    <label for="agent-filter" style="font-weight: bold; display: block; margin-bottom: 10px;">Filter by Agent:</label>
    <input type="text" name="agent" id="agent-filter" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box; width: 200px; margin-right: 10px;">

    <button type="submit" name="filterBtn" style="background-color: #4CAF50; color: white; cursor: pointer; padding: 10px 15px; border: 1px solid #3a933a; border-radius: 4px;">Filter</button>
  </form>
</div>


  <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
      <tr>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Agent Name</th>
		<th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Codice</th>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">NI</th>
		<th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Locker ID</th>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Locker case</th>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Case Emplacement</th>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Quantity to dump</th>
        <th style="background-color: #f2f2f2; font-weight: bold; padding: 10px; text-align: left; border-bottom: 1px solid #ddd;">Dumping date</th>
      </tr>
    </thead>
    <tbody>

    <?php


// Initialize the filter variables
$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterAgent = isset($_GET['agent']) ? $_GET['agent'] : '';

// Prepare the SQL query with the filter
if (!empty($filterDate) && !empty($filterAgent)) {
    // Both filters are provided
    $query = "SELECT username,id_cas,id_case,emp_case,NI,codice,qte_dump,dump_date FROM uncharging_repport WHERE DATE(dump_date) = '$filterDate' AND username LIKE '%$filterAgent%'";
} elseif (!empty($filterDate)) {
    // Only date filter is provided
    $query = "SELECT username,id_cas,id_case,emp_case,NI,codice,qte_dump,dump_date FROM uncharging_repport WHERE DATE(dump_date) = '$filterDate'";
} elseif (!empty($filterAgent)) {
    // Only agent filter is provided
    $query = "SELECT username,id_cas,id_case,emp_case,NI,codice,qte_dump,dump_date FROM uncharging_repport WHERE username LIKE '%$filterAgent%'";
} else {
    // No filters provided, show all data
    $query = "SELECT * FROM uncharging_repport ";
}

// Execute the query
$result = $conn->query($query);

// Check if the query execution was successful
if ($result === false) {
    die("Query execution failed: " . $conn->error);
}

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Loop through each row of data
    while ($row = $result->fetch_assoc()) {
        // Output the data into the table rows
  echo "<tr>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['username'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['codice'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['NI'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['id_cas'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['id_case'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['emp_case'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['qte_dump'] . "</td>";
  echo "<td style='padding: 10px; text-align: left; border-bottom: 1px solid #ddd; background-color: #F9F9F9;'>" . $row['dump_date'] . "</td>";

  echo "</tr>";
        
    }
} else {
    echo "<tr><td colspan='10'>No data found</td></tr>";
}

// Close the database connection
$conn->close();
?>

    </tbody>
  </table>
  <form method="GET" action="download_dump.php">
    <input type="hidden" name="date" value="<?php echo htmlspecialchars($filterDate); ?>">
    <input type="hidden" name="agent" value="<?php echo htmlspecialchars($filterAgent); ?>">
    <button type="submit" name="downloadBtn" style="background-color: #4CAF50; color: white; cursor: pointer; padding: 10px 15px; border: 1px solid #3a933a; border-radius: 4px;">
  <i class="fas fa-file-excel" style="margin-right: 5px;"></i> Download as Excel
</button>

</form>

<?php include '../footer.php'; ?>
