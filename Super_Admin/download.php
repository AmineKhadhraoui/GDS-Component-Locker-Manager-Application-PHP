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
               <th>Ni</th>
               <th>Codice</th>
               <th>Machine</th>
               <th>Table </th>
               <th>Emplacement</th>
               <th>Feder</th>
               <th>Changed_feder</th>
               <th>New_Ni</th>
               <th>date</th>
               
            </tr> ';
// Initialize the filter variables from the URL parameters
$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterAgent = isset($_GET['agent']) ? $_GET['agent'] : '';

// Prepare the SQL query with the filter
if (!empty($filterDate) && !empty($filterAgent)) {
    // Both filters are provided
    $query = "SELECT Agent_name, NI, Codice, Machine, Table_Machine, Emplacement, Feder, Changed_Feder, New_NI, date FROM testing_report WHERE DATE(date) = '$filterDate' AND Agent_name LIKE '%$filterAgent%'";
} elseif (!empty($filterDate)) {
    // Only date filter is provided
    $query = "SELECT Agent_name, NI, Codice, Machine, Table_Machine, Emplacement, Feder, Changed_Feder, New_NI, date FROM testing_report WHERE DATE(date) = '$filterDate'";
} elseif (!empty($filterAgent)) {
    // Only agent filter is provided
    $query = "SELECT Agent_name, NI, Codice, Machine, Table_Machine, Emplacement, Feder, Changed_Feder, New_NI, date FROM testing_report WHERE Agent_name LIKE '%$filterAgent%'";
} else {
    // No filters provided, show all data
    $query = "SELECT Agent_name, NI, Codice, Machine, Table_Machine, Emplacement, Feder, Changed_Feder, New_NI, date FROM testing_report";
}

// Execute the query
$result = $connection->query($query);

// Check if the query execution was successful
if ($result === false) {
    die("Query execution failed: " . $connection->error);
}
while($row =$result->fetch_assoc()){
  $export .= '                  
              <tr>
                 <td>'.$row['Agent_name'].'</td>
                 <td>'.$row['NI'].'</td>
                 <td>'.$row['Codice'].'</td>
                 <td>'.$row['Machine'].'</td>
                 <td>'.$row['Table_Machine'].'</td>
                 <td>'.$row['Emplacement'].'</td>
                 <td>'.$row['Feder'].'</td>
                 <td>'.$row['Changed_Feder'].'</td>
                 <td>'.$row['New_NI'].'</td>
                 <td>'.$row['date'].'</td>
                
              </tr>';

}            
$export .= '</table>';
   header('Content-Type: application/xls');
   header('Content-Disposition: attachment; filename=Daily_Record.xls');
   echo $export;
// Close the database connection
$connection->close();
