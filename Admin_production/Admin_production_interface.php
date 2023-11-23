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

<?php include '../footer.php'; ?>