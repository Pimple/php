<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->database();
		$query = $this->db->query('select * from weatherdata');

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
