<?php
$host = 'localhost';        // Replace with your database host
$username = 'root';         // Replace with your database username
$password = '';             // Replace with your database password
$database = 'clm';          // Replace with your database name

// Create a new MySQLi instance
$connection = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$export="";
$export .= '
         <table class="tftable" border="1" style="text-align: center;">
            <tr>
            <th>Agent name</th>
            <th>Codice</th>
            <th>NI </th>
            <th>Locker ID</th>
            <th>Locker case</th>
            <th>Case Emplacement</th>
            <th>Charging Date</th>
            <th>Quantity to charge</th>
            
               
            </tr> ';
// Initialize the filter variables from the URL parameters
$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterAgent = isset($_GET['agent']) ? $_GET['agent'] : '';

// Prepare the SQL query with the filter
if (!empty($filterDate) && !empty($filterAgent)) {
    // Both filters are provided
    $query = "SELECT username,charge_date,id_cas,id_case,emp_case,NI,codice,qte_charg FROM charging_report WHERE DATE(charge_date) = '$filterDate' AND username LIKE '%$filterAgent%'";
} elseif (!empty($filterDate)) {
    // Only date filter is provided
    $query = "SELECT username,charge_date,id_cas,id_case,emp_case,NI,codice,qte_charg FROM charging_report WHERE DATE(charge_date) = '$filterDate' ";
} elseif (!empty($filterAgent)) {
    // Only agent filter is provided
    $query = "SELECT username,charge_date,id_cas,id_case,emp_case,NI,codice,qte_charg FROM charging_report WHERE username LIKE '%$filterAgent%'";} else {
    // No filters provided, show all data
    $query = "SELECT * FROM charging_report ";}

// Execute the query
$result = $connection->query($query);

// Check if the query execution was successful
if ($result === false) {
    die("Query execution failed: " . $connection->error);
}
while($row =$result->fetch_assoc()){
  $export .= '                  
              <tr>
                 <td>'.$row['username'].'</td>
                 <td>'.$row['codice'].'</td>
                 <td>'.$row['NI'].'</td>
                 <td>'.$row['id_cas'].'</td>
                 <td>'.$row['id_case'].'</td>
                 <td>'.$row['emp_case'].'</td>
                 <td>'.$row['charge_date'].'</td>
                 <td>'.$row['qte_charg'].'</td>
                
              </tr>';

}            
$export .= '</table>';
   header('Content-Type: application/xls');
   header('Content-Disposition: attachment; filename=Daily_Record.xls');
   echo $export;
// Close the database connection
$connection->close();
