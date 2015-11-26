<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller
{
	public function index()
	{
		$this->load->database();

		$data['base_url'] = $this->config->item('base_url');
		$data["weather_reports"] = $this->db->get("weatherdata")->result_array();
		$cities = ["Randers", "Aalborg", "Aarhus", "Viborg", "Copenhagen"];
		$data["cities"] = $cities;

		$this->load->view('control_view', $data);
	}
}