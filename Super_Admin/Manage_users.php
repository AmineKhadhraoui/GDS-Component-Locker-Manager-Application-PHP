<?php include '../config.php'; ?>
<?php include '../header.php'; ?>


<head>
	<style>
		.icon-separator {
			margin: 0 5px;
			color: #999;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
		}

		.table th,
		.table td {
			padding: 10px;
			text-align: left;
		}

		.table th {
			background-color: #f2f2f2;
		}

		.table tr {
			background-color: #f9f9f9;
		}

		.table tr:hover {
			background-color: #f9f9f9;
		}

		.table a {
			color: #337ab7;
			text-decoration: none;
		}

		.table a:hover {
			text-decoration: underline;
		}

		.icon-separator {
			margin: 0 5px;
			color: #999;
		}




		.icon-list .icon-item .icon-link:hover {
			color: #5C9DDE;
		}



		@redColor: red;

		body {
			background-color: #1f0630;
			font-family: 'Open Sans', sans-serif;
		}

		.icon-list {
			margin: 0;
			padding: 0;
			height: 118px;
			border-radius: 3px;
			background-color: #fff;
		}

		.wrapper {
			margin: 10px;
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
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




		.add-user-button {
			padding: 10px;
			font-size: 16px;
			border: none;
			border-radius: 4px;
			background-color: #007bff;
			color: #fff;
		}

		.add-user-button a {
			color: #fff;
			text-decoration: none;
		}

		.add-user-button a:hover {
			text-decoration: none;
			color: gray;
		}

		.add-user-button i {
			margin-right: 5px;
		}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Admin</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<script src="assets/js/ace-extra.min.js"></script>


</head>



<div class="wrapper">
	<ul class="icon-list">
		<li class="icon-item">

			<a href="Dashboard_super_admin.php" class="icon-link">
				<i class="fa fa-tachometer"></i>
				<div class="icon-text">
					<Datag>Dashboard</Datag>
				</div>
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







<br><br><br><br><br><br><br>



<?php


// Check if user ID is provided in the URL parameter for deletion
if (isset($_GET['delete_id'])) {
	$deleteId = $_GET['delete_id'];

	// Delete the user from the database
	$deleteQuery = "DELETE FROM user WHERE user_id = '$deleteId'";
	if ($conn->query($deleteQuery) === TRUE) {
		echo '<script>alert("User deleted successfully.");</script>';
	} else {
		echo '<script>alert("Error deleting user: ' . $conn->error . '");</script>';
	}
}

// Retrieve users from the database
$query = "SELECT * FROM user";
$result = $conn->query($query);

// Check if any users are found
if ($result->num_rows > 0) {
	echo '<table class="table">
            <tr>
                <th>Username</th>
                <th>Privilege</th>
                <th>Actions</th>
            </tr>';

	// Loop through each user and display them in the table
	while ($row = $result->fetch_assoc()) {
		$userId = $row['user_id'];
		$username = $row['username'];
		$privelege = $row['privelege'];

		echo '<tr>
                <td>' . $username . '</td>
                <td>' . $privelege . '</td>
                <td>
                <a href=modify_user.php?id=' . $userId . '><i class="material-icons text-primary"  style="color:#007FFF;">edit</i></a> 
            <span class="icon-separator">|</span> 
            <a href="?delete_id=' . $userId . '"><i class="material-icons text-danger"  style="color:#EF0107">delete</i></a>
                </td>
            </tr>';
	}

	echo '</table>
	<button type="button" class="add-user-button">
  <i class="fas fa-user-plus"></i><a href="Add_user.php"> Add User</a>
</button>';
} else {
	echo 'No users found.';
}

// Close the database connection
$conn->close();
?>



<?php include '../footer.php'; ?>