<?php include '../config.php'; ?>

<?php include '../header.php'; ?>

<head>
  <style>
    /*
 * Developer: Alireza Eskandarpour Shoferi
 * Designer: Mike (dribbble.com/creativemints)
 *
 * Distributed under the terms of the MIT license
 * https://opensource.org/licenses/MIT
 */

    .background-container {
      background-image: url("assets/gds-logo.png");
      background-repeat: no-repeat;
      background-position: center;

      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
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
  </style>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="utf-8" />
  <title>Admin</title>

  <meta name="description" content="overview &amp; stats" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- bootstrap & fontawesome -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

  <!-- page specific plugin styles -->

  <!-- text fonts -->
  <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

  <!-- ace styles -->
  <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

  <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
  <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
  <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

  <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

  <!-- inline styles related to this page -->

  <!-- ace settings handler -->
  <script src="assets/js/ace-extra.min.js"></script>

  <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

  <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>





<div class="wrapper">
  <ul class="icon-list">
    <li class="icon-item">

      <a href="Dashboard_Admin_Production.php" class="icon-link">
        <i class="fa fa-tachometer"></i>
        <div class="icon-text">
          <Datag>Dashboard</Datag>
        </div>
      </a>
    </li>
    <li class="icon-item current">

      <a href="Products_list.php" class="icon-link">
        <i class="fa fa-cube"></i>
        <div class="icon-text">Managae Products</div>
      </a>
    </li>


    <li class="icon-item">
      <a href="report_testing_component.php" class="icon-link">
        <i class="fa fa-file-text-o"></i>

        <div class="icon-text">Export Report</div>
      </a>
    </li>

  </ul>
</div>
























<div class="background-container">

  <br<br><br><br>
    <br<br><br><br>
      <br<br><br><br>
        <br<br><br><br>
          <br<br><br>
            <div class="container mt-5">
              <div class="row">
                <div class="col-md-6">
                  <div class="card"
                    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f0f0f0;">
                    <div class="card-body" style="text-align: center;">
                      <h3 style="font-size: 24px; margin-bottom: 15px;">
                        <i class="fas fa-cubes"></i> Active Products
                      </h3>
                      <p id="activeProductCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
                        <?php echo getActiveProductCount(); ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card"
                    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #e0e0e0;">
                    <div class="card-body" style="text-align: center;">
                      <h3 style="font-size: 24px; margin-bottom: 15px;">
                        <i class="fas fa-ban disabled-icon"></i>
                        Disabled Products
                      </h3>
                      <p id="disabledProductCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
                        <?php echo getDisabledProductCount(); ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card"
                    style="margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #e0e0e0;">
                    <div class="card-body" style="text-align: center;">
                      <h3 style="font-size: 24px; margin-bottom: 15px;">
                        <i class="fas fa-microchip"></i> Total Components
                      </h3>
                      <p id="componentCount" style="font-size: 32px; font-weight: bold; color: #007bff;">
                        <?php echo getComponentCount(); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Include Chart.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
            <!-- Include your custom script -->
            <script src="path/to/your/script.js"></script>


























            <?php include '../footer.php'; ?>










            <?php
            // Function to establish a database connection (modify these values accordingly)
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

            // Function to get the product count
            function getActiveProductCount()
            {
              try {
                $pdo = getDBConnection();
                $stmt = $pdo->query("SELECT COUNT(*) AS activeProductCount FROM product WHERE Status = 'Enabled'");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['activeProductCount'];
              } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
              }
            }

            // Function to get the disabled product count
            function getDisabledProductCount()
            {
              try {
                $pdo = getDBConnection();
                $stmt = $pdo->query("SELECT COUNT(*) AS disabledProductCount FROM product WHERE status = 'Disabled'");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['disabledProductCount'];
              } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
              }
            }

            // Function to get the component count
            function getComponentCount()
            {
              try {
                $pdo = getDBConnection();
                $stmt = $pdo->query("SELECT COUNT(*) AS componentCount FROM component");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['componentCount'];
              } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
              }
            }
            ?>