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
		$headerData['showPostItem'] = FALSE;
		$data['title'] = ucfirst($page);

		$this->load->view('header', $headerData);
		$this->load->view('search');
	}

	public function getItems() {
		// TODO: do some form validation here

		$postData = $this->input->post(NULL, FALSE);
		$filter = array();

		foreach($postData as $key => $value) {
			if (!empty($value)) {
				$filter[$key] = array('$regex' => $value);
			}
		}

		//$data['items'] = var_dump($filter);
		$data['items'] = $this->search_model->getItemsFromDB($filter);

		$this->load->view('search/search_results', $data);
	}

	//Searches using a full text search
	public function search() {
		$query = $_GET['search'];
		$page = $_GET['page'];
		$results = $this->search_model->searchByIndex($query, $page);
		echo $results;
	}

	//Fetches the newest items posted
	public function new() {
		$page = $_GET['page'];
		$results = $this->search_model->getNewest($page);
		echo $results;
	}

	//Fetches an item by their id
	public function id() {
		$id = $_GET['id'];
		$results = $this->search_model->getById($id);
		echo $results;
	}
}