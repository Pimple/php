<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function index()
	{
		$weather_key = "657e91b342e3ba80";
		$country_code = "Denmark";
		$cities = ["Randers", "Aalborg", "Aarhus", "Viborg", "Copenhagen"];

		$this->load->database();
		$query = $this->db->query('select max(timestamp) from weatherdata');

		$now = date("Y-m-d H:i:s");

		if (count($query->result_array()) > 0)
		{
			$latest_timestamp = strtotime($query->result_array()[0]["max(timestamp)"]);
			$data["test"] = $latest_timestamp;

			if (date("Y-m-d", $latest_timestamp) < date("Y-m-d", strtotime($now)) or
					(date("Y-m-d", $latest_timestamp) == date("Y-m-d", strtotime($now)) and
					date("H", $latest_timestamp) +24 < date("H", strtotime($now))))
			{
				$this->db->query("truncate table weatherdata");

				$dates = array();
				foreach ($cities as $city)
				{
					$service_url = "http://api.wunderground.com/api/" . $weather_key . "/forecast/q/" . $country_code . "/" . $city . ".json";
					$forecast_json = file_get_contents($service_url);
					$forecast = json_decode($forecast_json, true);

					$iSigh = 0;

					for ($i = 0; $i < 8; $i++)
					{
						if ($iSigh > 0 and $i % 2 == 0)
							$iSigh -= 1;

						$date_to_enter = null;
						$temperature_high = null;
						$temperature_low = null;
						$wind = null;
						$humidity = null;
						if (count($forecast["forecast"]["simpleforecast"]["forecastday"]) > $iSigh)
						{
							$new_date = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["date"]["epoch"];
							$date_to_enter = new DateTime("@$new_date");
							$date_to_enter = $date_to_enter->format("Y-m-d H:i:s");
							$temperature_high = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["high"]["celsius"];
							$temperature_low = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["low"]["celsius"];
							$wind = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["avewind"]["kph"];
							$humidity = $forecast["forecast"]["simpleforecast"]["forecastday"][$iSigh]["avehumidity"];
						}
						// $city
						$text = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["fcttext_metric"];
						$icon = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["icon"];
						$icon_url = $forecast["forecast"]["txt_forecast"]["forecastday"][$i]["icon_url"];

						$iSigh++;

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
			}
		}

//		$weather = $this->db->get("weatherdata");
//
//		$this->load->library('table');
//
//		$template = array
//		(
//			'table_open'            => '<div class="table-responsive"><table class="table table-striped">',
//			'table_close'           => '</table></div>'
//		);
//		$this->table->set_template($template);
//		$data['table'] = $this->table->generate($weather);
//
//		$this->config->load('config');
		$data['base_url'] = $this->config->item('base_url');

		$data["weather_reports"] = $this->db->get("weatherdata")->result_array();
		$data["cities"] = $cities;

		$this->load->view('main_view', $data);
	}
}
