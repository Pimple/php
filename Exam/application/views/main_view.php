<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
	<title>The weather forecast is FABULOUS!</title>
	<link rel="stylesheet" href="stylish/bootstrap.min.css">
	<link rel="stylesheet" href="stylish/bootstrap-responsive.css">
	<link rel="stylesheet" href="stylish/bootswatch.css">
	<link rel="stylesheet" href="stylish/prettify.css">
	<link rel="stylesheet" href="stylish/fabulous.css">
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
	<h1>The weather forecast is.....<span class="rainbow">FABULOUS!</span></h1>
	<link async href="http://fonts.googleapis.com/css?family=Bad%20Script" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>

	<div class="align-center">
		<!-- TRIPLE MC HAMMER -->
		<img src="picturesque/mchammer.gif">&nbsp;&nbsp;
		<img src="picturesque/mchammer.gif">&nbsp;&nbsp;
		<img src="picturesque/mchammer.gif">
		<br><br>

		<select id="cities" onChange="setCity(this)">
		<?php foreach ($cities as $city): ?>
			<option value="<?php echo $city ?>"><?php echo ucfirst($city) ?></option>
		<?php endforeach; ?>
		</select><br>
		<a href="<?php echo $base_url ?>index.php/control">Change the weather</a>
	</div>
	<br>

	<?php foreach ($weather_reports as $report): ?>
	<div class="col-xs-6 weather_report">
		<h2><?php echo $report["city"] ?><img src="<?php echo $report["icon_url"] ?>"></h2>
		<h3><?php echo $report["date"] ?></h3>

		<p>
			Min <?php echo $report["temperature_low"] ?>° - max <?php echo $report["temperature_high"] ?>°.
			Humidity of <?php echo $report["humidity"] ?> and wind speed of <?php echo $report["wind"] ?> km/h.
		</p>
		<p><?php echo $report["text"] ?></p>
	</div>

	<?php endforeach; ?>
</div>

</body>
</html>