<?php include '../config.php'; ?>

<?php include '../header.php'; ?>


<a href="Manage_users.php" style="position: fixed; left:  20px; Top:80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
    <i style="margin-right: 8px;">&larr;</i> Go Back
  </a>
  <br><br>
    <?php
// Include the database configuration file

// Check if user ID is provided in the URL parameter
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve user details from the form
        $username = $_POST['username'];
        $privelege = $_POST['privelege'];
        $password = $_POST['password'];

        // Update the user in the database
        $query = "UPDATE user SET username = '$username', privelege = '$privelege', password = '$password' WHERE user_id = '$userId'";
        $result = $conn->query($query);

        if ($result === TRUE) {
            echo '<script>alert("User updated successfully.");</script>';
        } else {
            echo '<script>alert("Error updating user: ' . $conn->error . '");</script>';
        }

    }

    // Retrieve user details from the database
    $query = "SELECT * FROM user WHERE user_id = '$userId'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $privelege = $row['privelege'];

        // Display the user details in a form for modification
        echo '
        <html>
        <head>
            <style>
              body{

                background-image: url("assets/gds-logo.png");
  background-repeat: no-repeat;
  background-position: center;
  
              }
                  
            .form-container select {
              width: 100%;
              padding: 10px;
              margin-bottom: 15px;
              border: 1px solid #ccc;
              border-radius: 4px;
              box-sizing: border-box;
              appearance: none;
             
              background-image: url("path_to_dropdown_arrow_icon.png");
              background-repeat: no-repeat;
              background-position: right center;
              cursor: pointer;
              height: 40px; /* Adjust the height as needed */
            }
            

            .form-container {
              width: 600px;
              background-color: #fff;
              padding: 20px;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              margin: 0 auto; /* Center the form horizontally */
              margin-top: 100px; /* Adjust the top margin as needed */
              margin: 70px auto;
  max-width: 500px;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.7); /* Set the background color with opacity */
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8px); 
  
            }
            

                .form-container select {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                    appearance: none;
                    background-color: #fff;
                    background-image: url("path_to_dropdown_arrow_icon.png");
                    background-repeat: no-repeat;
                    background-position: right center;
                    cursor: pointer;
                }

                .form-container select option {
                    padding: 10px;
                    background-color: #f9f9f9;
                    color: #333;
                }

                .form-container select option:hover {
                    background-color: #e6e6e6;
                }

                .form-container label {
                    display: block;
                    margin-bottom: 8px;
                    color: #666;
                }

                .form-container input[type="text"],
                .form-container input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                .form-container input[type="submit"] {
                    background-color: #4CAF50;
                    color: #fff;
                    padding: 10px 16px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                    margin: 0 auto;
                    display: block;
                }

                .form-container input[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body class="class1">
            <form method="post" action="modify_user.php?id=' . $userId . '" class="form-container" >
                <center><h2>Modify User</h2></center>
                <input type="hidden" name="id" value="' . $userId . '">
                <label class="form-label">Username:</label>
                <input type="text" name="username" value="' . $username . '" class="form-input">
                <label class="form-label" for="privelege">Privelege:</label>
                <select name="privelege" id="privelege" required class="form-select">
                    <option value="Super Admin" ' . ($privelege === "Super Admin" ? "selected" : "") . '>Super Admin</option>
                    <option value="Production Admin" ' . ($privelege === "Production Admin" ? "selected" : "") . '>Production Admin</option>
                    <option value="Production Agent" ' . ($privelege === "Production Agent" ? "selected" : "") . '>Production Agent</option>
                    <option value="Locker Admin" ' . ($privelege === "Locker Admin" ? "selected" : "") . '>Locker Admin</option>
					<option value="Locker Agent" ' . ($privelege === "Locker Agent" ? "selected" : "") . '>Locker Agent</option>
                </select>
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-input">
                <input type="submit" value="Update" class="form-submit">
            </form>
        </body>
        </html>';
    } else {
        echo 'User not found.';
    }
} else {
    echo 'User ID not provided.';
}

// Close the database connection
$conn->close();
?>


<?php include '../footer.php'; ?>