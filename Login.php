<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database configuration file
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "CLM"; // Replace with your database name

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Assuming you have a database connection established

// Check if the login form is submitted

  // Retrieve the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform the database query to check the credentials
  $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    // User authentication succeeded

    // Retrieve the user's privilege level from the result
    $user = mysqli_fetch_assoc($result);
    $privelege = $user['privelege'];

    $_SESSION['username'] = $username;
    $_SESSION['privilege'] = $privilege;

    // Redirect the user based on their privilege level
    switch ($privelege) {
      case 'Super Admin':
        header("Location: Super_Admin/Super_Admin_interface.php");
        exit();
      case 'Production Admin':
        header("Location: Admin_production/Admin_production_interface.php");
        exit();
      case 'Production Agent':
        header("Location: Agent_production/Testing_component.php");
        exit();
      case 'Locker Admin':
        header("Location: Locker_Admin/Locker_charging1.php");
        exit();
      case 'Locker Agent':
        header("Location: Locker_Agent/Locker_Agent_interface.php");
        exit();
      default:
        // Handle unrecognized privilege levels
        echo "<script>alert('Invalid privilege level.');</script>";
        break;
    }
  } else {
    // User authentication failed
    echo "<script>alert('Invalid username or password.');</script>";
  }
}
?>


<html>
    <head>
    <style>
        html {
            background: #e3e3ff;
        }
        
        .body-content {
            padding-top: 10vh;
        }
        
        .container {
            width: 350px;
            height: 452px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: auto;
            border: 2px solid White;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.3); /* Set the background color with opacity */
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8px);
        }
        
        .logo {
            margin-top: 0px;
            padding-top: 0;
            
        }
        
        .logo img {
            width: 100px;
           
        }
        
        h2 {
            color: white;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        form {
            display: flex;
            flex-direction: column;
        }
        
        .form-item {
            margin: 5px;
            padding-bottom: 10px;
            display: flex;
        }
        
        .form-item label {
            display: block;
            padding: 2px;
            font-size: 20px;
            width: 100px;
        }
        
        .form-item input {
            width: 320px;
            height: 35px;
            border: 2px solid #e1dede69;
            border-radius: 20px;
            background: white;
            color: black;
            text-align: center;
        }
        
        .remember-box {
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            color: white;
        }
      
        
        .remember-box a {
            text-decoration: none;
            color: white;
            margin-left:30px;

        }
        .remember-box a:hover {
            color:grey;
        }
        
        .form-btns {
            display: flex;
            flex-direction: column;
            margin: auto;
            padding: 10px 0;
        }
        
        .form-btns button {
            margin: auto;
            font-size: 20px;
            padding: 5px 15px;
            border: 0;
            border-radius: 15px;
            color: rgb(75, 61, 61);
            background: #fbba50;
            width: 280px;
            cursor: pointer;
        }
        .form-btns button:hover {
            background: #d88a0c;
            color: antiquewhite;
        }
        
        .options {
            padding-top: 15px;
            margin: auto;
        }
        
        .options a {
            text-decoration: none;
            color: white;
            margin: 0 40px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }
        .options a:hover {
            color:grey;
        }
        
        p {
            text-align: center;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }
  body {
  background: linear-gradient(to bottom, #2c3e50, #7f8c8d);

}


    </style>
</head>
<body>
<!--<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <input type="submit" value="Log in">
</form>-->
<div class="body-content">

        <div class="container">
            <div class="logo">
                <img src="logo_gds_100.png "  >
            </div>
            <h2>User Login</h2>
            <div class="login-form">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-item">
                        <!-- <label for="userName">Username:</label> -->
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-item">
                        <!-- <label for="passWord">Password:</label> -->
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="form-btns">

                        <button type="submit" value="Log in">Login</button>
                        


                    </div>
                </form>
                <p>Copyright &copy; GDS 2023</p>
            </div>
        </div>
    </div>
</body>

</html>