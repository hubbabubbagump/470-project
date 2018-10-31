<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	private $showLogin = TRUE;

	public function __construct() {
		parent::__construct();
		session_start();

		$this->load->model('search_model');
	}

	public function test($page = 'home') {
		if (isset($_SESSION['user_id'])) {
            $this->showLogin = FALSE;
		}

		$headerData['showLogin'] = $this->showLogin;
		$data['title'] = ucfirst($page);

		$this->load->view('header', $headerData);
		$this->load->view('search');
	}

	public function getItems() {
		// TODO: do some form validation here

		$courseNum = $this->input->post("searchQuery");

		$data['items'] = json_encode($this->search_model->getItems($courseNum));

		$this->load->view('search/search_results', $data);
	}
}