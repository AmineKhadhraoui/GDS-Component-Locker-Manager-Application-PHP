<?php include '../config.php'; ?>

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
			margin: 10px 0 0 -450px;
			width: 880px;
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





<a href="Manage_users.php"
	style="position: fixed; left: 20px;Top:80px; transform: translateY(-50%); display: block; background-color: gray; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
	<i style="margin-right: 8px;">&larr;</i> Go Back
</a>

<div class="wrapper">
	<ul class="icon-list">

		<li class="icon-item current">

			<a href="charging_rapport.php" class="icon-link">
				<i class="fa fa-file-text-o"></i><i class="fas fa-plus"></i>

				<div class="icon-text">Charging Report</div>
			</a>
		</li>
		<li class="icon-item">
			<a href="Déchargement_rapport.php" class="icon-link">
				<i class="fa fa-file-text-o"></i><i class="fas fa-minus"></i>


				<div class="icon-text">Uncharging Report</div>
			</a>
		</li>

		<li class="icon-item">
			<a href="return_report.php" class="icon-link">
				<i class="fa fa-file-text-o"></i><i class="fas fa-arrow-left"></i>

				<div class="icon-text">Return Report</div>
			</a>
		</li>

		<li class="icon-item">
			<a href="report_testing_component.php" class="icon-link">
				<i class="fa fa-file-text-o"></i><i class="fas fa-check-circle" ></i>


				<div class="icon-text">Testing Report</div>
			</a>
		</li>

	</ul>
</div>






<?php include '../footer.php'; ?>