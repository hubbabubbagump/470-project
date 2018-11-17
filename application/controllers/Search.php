<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	private $showLogin = TRUE;

	public function __construct() {
		parent::__construct();
		session_start();

		$this->load->model('search_model');
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