<?php include '../config.php'?>

<?php include '../header.php'; ?>
	<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            
/*
 * Developer: Alireza Eskandarpour Shoferi
 * Designer: Mike (dribbble.com/creativemints)
 *
 * Distributed under the terms of the MIT license
 * https://opensource.org/licenses/MIT
 */








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
    margin: 10px ;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 440px;
}

.icon-item {
    display: inline-block;
    /* Removes the default space between items */
    margin-right: -4px;
    width: 220px;
    text-align: center;
}
.icon-item:hover > a,
.current > a {
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
		<title>Locker Agent</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
   
    <li class="icon-item current">
     
    <a href="Locker_dump.php" class="icon-link">
	<i class="fas fa-archive"></i><i class="fas fa-minus"></i>

        <div class="icon-text">Uncharge Locker</div>
      </a>
    </li>

   

    <li class="icon-item">
      <a href="retour.php" class="icon-link">
      <i class="fas fa-arrow-left"></i>

        <div class="icon-text">Component Return</div>
      </a>
    </li>
   
  </ul>
</div>



<?php include '../footer.php'; ?>
