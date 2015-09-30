<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTest extends CI_Controller
{
	public function index()
	{
		$this->load->database();
		$query = $this->db->query('select id, username, firstname, lastname, email, gender from randomusers');

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

		$this->load->view('datatest_view', $data);
	}
}