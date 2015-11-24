<?php

include_once("constants.php");

function fetch_next_forecast()
{
	$dates = array();
	foreach (cities as $city)
	{
		$service_url = "http://api.wunderground.com/api/" . weather_key . "/current/q/" . country_code . "/" . $city . ".json";
		$forecast_json = file_get_contents($service_url);
		$forecast = json_decode($forecast_json, true);

		for ($i = 0; $i < 7; $i++)
		{
			$period = ["simpleforecast"]["forecastday"][$i]["period"];

			$iSigh = 0;
			if ($i + 1 % 2 == 0)
				$iSigh = ($i + 1) / 2;
			else
				$iSigh = round(($i + 1) / 2) + 1;

			$date_to_enter = ["simpleforecast"]["forecastday"][$i]["date"]["epoch"];
			$temperature_high = $forecast["simpleforecast"]["forecastday"][$i]["high"]["celsius"];
			$temperature_low = $forecast["simpleforecast"]["forecastday"][$i]["low"]["celsius"];
			$wind = $forecast["simpleforecast"]["forecastday"][$iSigh]["avewind"]["kph"];
			$humidity = $forecast["simpleforecast"]["forecastday"][$iSigh]["avehumidity"];
			// $city
			$text = $forecast["txt_forecast"]["forecastday"][$iSigh]["fxtext_metric"];
			$icon = $forecast["txt_forecast"]["forecastday"][$iSigh]["icon"];
			$icon_url = $forecast["txt_forecast"]["forecastday"][$iSigh]["icon_url"];

			$data_entry = array
			(
				"date" => $date_to_enter,
				"temperature_high" => $temperature_high,
				"temperature_low" => $temperature_low,
				"wind" => $wind,
				"humidity" => $humidity,
				"city" => $city,
				"text" => $text,
				"icon" => $icon,
				"icon_url" => $icon_url
			);
			array_push($dates, $data_entry);
		}
	}
	return $dates;
}

