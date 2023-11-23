<?php include '../config.php';?>

<?php include '../header.php'; ?>




<head>
	<style>

		

		.icon-list .icon-item .icon-link:hover {
			color: #5C9DDE;
		}

		@redColor: red;

		

		.icon-list {
			margin: 0;
			padding: 0;
			height: 118px;
			border-radius: 3px;
			background-color: #fff;
		}

		.wrapper {
			position: absolute;
			left: 50%;
			margin: 10px 0 0 -330px;
			width: 660px;
		}

		.icon-item {
			display: inline-block;
			/* Removes the default space between items */
			margin-right: -4px;
			width: 220px;
			text-align: center;
		}

		.icon-item:hover>a,
		.current>a {
			color: @redColor;
		}

		.current {
			margin-top: -6px;
			border-top: 6px solid @redColor;
			border-bottom: 6px solid @redColor;
		}

		.current::before {
			display: block;
			margin: 0 auto -6px auto;
			width: 0;
			border-top: 6px solid @redColor;
			border-right: 8px solid transparent;
			border-left: 8px solid transparent;
			content: "";
		}

		a.icon-link {
			display: block;
			box-sizing: border-box;
			padding-top: 19px;
			height: 118px;
			border-right: thin solid #e0e1db;
			text-decoration: none;
			font-size: 2.375em;
		}

		a.icon-link,
		a.icon-link:visited {
			color: #848577;
		}

		.icon-text {
			margin-top: 5px;
			font-size: 20px;
		}
	</style>
	</head>



        <div class="wrapper">
  <ul class="icon-list">
    <li class="icon-item">
     
    <a href="#" class="icon-link">
      <i class="fa fa-tachometer"></i>
        <div class="icon-text"><Datag>Dashboard</Datag></div>
      </a>
    </li>
    <li class="icon-item current">
     
    <a href="Manage_users.php" class="icon-link">
    <i class="fa fa-user"></i>
        <div class="icon-text">Manage Users</div>
      </a>
    </li>
	<li class="icon-item">
      <a href="Reports.php" class="icon-link">
      <i class="fa fa-file-text-o"></i>

        <div class="icon-text">Export Rapport</div>
      </a>
    </li>

  </ul>
</div>



<br<br><br><br>
    <br<br><br><br>
      <br<br><br><br>
        <br<br><br><br>
          <br<br><br>

<div class="col-md-6">
  <div class="card"
    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f0f0f0;">
    <div class="card-body" style="text-align: center;">
      <h3 style="font-size: 24px; margin-bottom: 15px;">
        <i class="fas fa-user"></i> Number of users
      </h3>
      <p id="userCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
        <?php echo getUserCount(); ?>
      </p>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card"
    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #e0e0e0;">
    <div class="card-body" style="text-align: center;">
      <h3 style="font-size: 24px; margin-bottom: 15px;">
       <!-- Place the icons where you want them to appear in your HTML file -->
<i class="fas fa-microchip"></i> <i class="fas fa-plus"></i>
 Charged Components
      </h3>
      <p id="chargedComponentCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
        <?php echo getChargedComponentCount(); ?>
      </p>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card"
    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #e0e0e0;">
    <div class="card-body" style="text-align: center;">
      <h3 style="font-size: 24px; margin-bottom: 15px;">
       <!-- Place the icons where you want them to appear in your HTML file -->
<i class="fas fa-microchip"></i> <i class="fas fa-minus"></i>
 Dumped Components
      </h3>
      <p id="dumpedComponentCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
        <?php echo getDumpedComponentCount(); ?>
      </p>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card"
    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #e0e0e0;">
    <div class="card-body" style="text-align: center;">
      <h3 style="font-size: 24px; margin-bottom: 15px;">
        <i class="fas fa-undo"></i> Returned Components
      </h3>
      <p id="returnedComponentCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
        <?php echo getReturnedComponentCount(); ?>
      </p>
    </div>
  </div>
</div>






<?php include '../footer.php'; ?>




<?php
// Existing functions for active, disabled products, and total components

// ...

// Function to get the user count
 function getDBConnection()
            {
                $host = 'localhost'; // Replace with your database host
                $username = 'root'; // Replace with your database username
                $password = ''; // Replace with your database password
                $database = 'clm';
  
                $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
              }
function getUserCount()
{
  try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) AS userCount FROM user");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['userCount'];
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  }
}

// Function to get the charged component count
function getChargedComponentCount()
{
  try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) AS chargedComponentCount FROM charging_report");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['chargedComponentCount'];
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  }
}

// Function to get the dumped component count
function getDumpedComponentCount()
{
  try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) AS dumpedComponentCount FROM uncharging_repport");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['dumpedComponentCount'];
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  }
}

// Function to get the returned component count
function getReturnedComponentCount()
{
  try {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) AS returnedComponentCount FROM retour");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['returnedComponentCount'];
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  }
}
?>

