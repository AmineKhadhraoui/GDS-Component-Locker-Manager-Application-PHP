<?php include '../config.php'; ?>

<?php include '../header.php'; ?>



<a href="Manage_users.php" style="position: fixed; left: 20px;Top:80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
    <i style="margin-right: 8px;">&larr;</i> Go Back
  </a>

<div class="background-container">
	<br><br><br><br>
	<div style=" font-family: Arial, sans-serif;
			
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
			<h2 style="text-align: center;
			font-size: 24px;
			margin-bottom: 20px;">Add User</h2>
			<form class="form" method="POST" style="">
				<div style=" margin-bottom: 20px;  
			">
					<label for="username" style=" display: block;
			font-weight: bold;
			margin-bottom: 5px;">Username:</label>
					<input type="text" name="username" id="username" required style="  width: 100%;
			padding: 10px;
			border-radius: 3px;
			border: 1px solid #ccc;
			font-size: 16px;">
				</div>
				<div style=" margin-bottom: 20px;">
					<label for="password" style=" display: block;
			font-weight: bold;
			margin-bottom: 5px;">Password:</label>
					<input type="password" name="password" id="password" required style="  width: 100%;
			padding: 10px;
			border-radius: 3px;
			border: 1px solid #ccc;
			font-size: 16px;">
				</div>
				<div style=" margin-bottom: 20px;">
					<label for="privelege" style=" display: block;
			font-weight: bold;
			margin-bottom: 5px;">Privelege:</label>
					<select name="privelege" id="privelege" required style="  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 20px;
  font-size: 16px;
  height:50px;
  overflow-y: auto;
	  
  width: 100%;">
						<option value="Super Admin">Super Admin</option>
						<option value="Production Admin">Production Admin</option>
						<option value="Production Agent">Production Agent</option>
						<option value="Locker Admin">Locker Admin</option>
						<option value="Locker Agent">Locker Agent</option>
					</select>
				</div>
				<button type="submit" style=" display: block;
			width: 100%;
			padding: 10px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;">Add User</button>
			</form>
		</div>
	</div>

</div>




<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {


	// Retrieve form data
	$username = $_POST['username'];
	$password = $_POST['password'];
	$privelege = $_POST['privelege'];

	// Prepare and execute the SQL query
	$stmt = $conn->prepare("INSERT INTO user (username, password, privelege) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $username, $password, $privelege);
	$stmt->execute();

	// Check if the user was successfully added
	if ($stmt->affected_rows > 0) {
		echo "<script>alert('User added successfully.'); window.location.href = 'Manage_users.php';</script>";
		exit;
	} else {
		echo "<script>alert('Error adding user.');</script>";
	}

	$stmt->close();
	$conn->close();
}
?>


<?php include '../footer.php'; ?>