<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("application/control_security.php");

secure_session_start();

if (isset($_GET["logout"]) and $_GET["logout"] == 1)
	logout($base_url);

if (isset($_POST['email'], $_POST['p']))
{
	$email = $_POST['email'];
	$password = $_POST['p'];
	$encrypted = hash("sha512", $password . SALT);

	if (login($email, $password) === false)
		header("Location: $base_url" . "index.php/control?login_failed");
}

if (isset($_GET["city"]))
{
	$city = $_GET["city"];
	$relevant_reports = array();
	foreach ($weather_reports as $report)
		if ($report["city"] == $city)
			array_push($relevant_reports, $report);
	$weather_reports = $relevant_reports;
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Weather Control (patent pending)</title>
	<link rel="stylesheet" href="<?php echo $base_url ?>stylish/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $base_url ?>stylish/bootstrap-responsive.css">
	<link rel="stylesheet" href="<?php echo $base_url ?>stylish/bootswatch.css">
	<link rel="stylesheet" href="<?php echo $base_url ?>stylish/prettify.css">
	<link rel="stylesheet" href="<?php echo $base_url ?>stylish/fabulous.css">
	<script type="text/JavaScript" src="<?php echo $base_url ?>scripted/sha512.js"></script>
	<script type="text/JavaScript" src="<?php echo $base_url ?>scripted/forms.js"></script>
	<script type="text/javascript">
		function setCity(city)
		{
			window.location.assign(window.location.href + "?city=" + city.value);
		}
		<?php if (isset($_GET["city"])): ?>
		function selectCity()
		{
			var cities = document.getElementById("cities");
			cities.value = <?php echo $city ?>;
		}
		window.onload = selectCity;
		<?php endif; ?>
	</script>
</head>
<body>

<div id="wrapper">
	<div class="align-center control">
		<h1><span class="rainbow">Olympus</span> Weather Control</h1>
		<link async href="http://fonts.googleapis.com/css?family=Bad%20Script" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>

		<!-- TRIPLE MC HAMMER -->
		<img src="<?php echo $base_url ?>picturesque/mchammer.gif">&nbsp;&nbsp;
		<img src="<?php echo $base_url ?>picturesque/mchammer.gif">&nbsp;&nbsp;
		<img src="<?php echo $base_url ?>picturesque/mchammer.gif">
		<br><br>
		<div class="align-center">
			<a href="<?php echo $base_url?>index.php/control?logout=1">Log out</a>
		</div>


		<?php if (!login_check()): ?>
		<h2><?php echo isset($_GET["login_failed"]) ? "Login failed, try again" : "Dude, log in"; ?></h2><br>
		<form action="<?php echo $base_url ?>index.php/control" method="post" name="login_form">
			Email: <input type="text" name="email" />
			Password: <input type="password" name="password" id="password"/>
			<input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
		</form>


		<?php else: ?>
			<br><br>
		<div class="align-center">
			<select id="cities" onChange="setCity(this)">
				<option value=""></option>
				<?php foreach ($cities as $city): ?>
					<option value="<?php echo $city ?>"><?php echo ucfirst($city) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<br>

		<?php foreach ($weather_reports as $report): ?>
			<div class="col-xs-6 weather_report">
				<h2><a href="<?php echo $base_url ?>index.php/control/delete/<?php echo $report["id"] ?>" class="delete">X</a> <?php echo $report["city"] ?><img src="<?php echo $report["icon_url"] ?>"></h2>
				<h3><?php echo $report["date"] ?></h3>

				<p>
					Min <?php echo $report["temperature_low"] ?>° - max <?php echo $report["temperature_high"] ?>°.
					Humidity of <?php echo $report["humidity"] ?> and wind speed of <?php echo $report["wind"] ?> km/h.
				</p>
				<p><?php echo $report["text"] ?></p>
			</div>

		<?php endforeach; ?>

		<?php endif; ?>
	</div>
</div>

</body>
</html>