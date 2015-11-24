<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function index()
	{
		$weather_key = "657e91b342e3ba80";
		$country_code = "Denmark";
		$cities = ["Viborg", "Copenhagen"];

		$this->load->database();
		$query = $this->db->query('select max(timestamp) from weatherdata');
		$data["test"] = "Test text unchanged";
//		if ($query->num_rows > 0)
//		{
//			$latest_timestamp = $query->result_object->timestamp;
//
//			$data["test"] = $latest_timestamp;
//			$current_timestamp = date("Y-m-d H:i:s");
//
//			if (date("Y-m-d", $latest_timestamp) < date("Y-m-d", $current_timestamp) or
//					date("Y-m-d", $latest_timestamp) == date("Y-m-d", $current_timestamp) and
//					date("H", $latest_timestamp) > date("H", $current_timestamp))
//			{
				$dates = array();
				foreach ($cities as $city) {
					$service_url = "http://api.wunderground.com/api/" . $weather_key . "/forecast/q/" . $country_code . "/" . $city . ".json";
					$forecast_json = file_get_contents($service_url);
					$forecast = json_decode($forecast_json, true);
					$data["test"] = $forecast_json;

					for ($i = 0; $i < 8; $i++)
					{
						$period = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["period"];

						$iSigh = 0;
						if ($i + 1 % 2 == 0)
							$iSigh = ($i + 1) / 2 - 1;
						else
							$iSigh = round(($i + 1) / 2);

						$date_to_enter = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["date"]["epoch"];
						$temperature_high = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["high"]["celsius"];
						$temperature_low = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["low"]["celsius"];
						$wind = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["avewind"]["kph"];
						$humidity = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["avehumidity"];
						// $city
						$text = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["fcttext_metric"];
						$icon = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["icon"];
						$icon_url = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["icon_url"];

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
				$this->db->insert_batch("weatherdata", $dates);
//			}
//		}

		$weather = $this->db->get("weatherdata");

		$this->load->library('table');

		$template = array
		(
			'table_open'            => '<div class="table-responsive"><table class="table table-striped">',
			'table_close'           => '</table></div>'
		);
		$this->table->set_template($template);
		$data['table'] = $this->table->generate($query);

		$this->config->load('config');
		$data['base_url'] = $this->config->item('base_url');

		$this->load->view('main_view', $data);
	}
}
