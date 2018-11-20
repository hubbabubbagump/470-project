<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Item extends CI_Controller 
	{
		private $headerData = array();

		public function __construct()
		{
			parent::__construct();
			session_start();

			if(isset($_SESSION['user_id'])) {
				$this->headerData['showLogin'] = FALSE;
				$this->headerData['showPostItem'] = TRUE;
				
				$this->load->model('item_model');
				$this->load->model('search_model');

				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->helper('url');
			}
		}
		
		public function index() 
		{
			// load view of form
			$this->load->view('header', $this->headerData);
			$this->load->view('add_item_page');
		}
    

		public function create()
		{
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$data['title'] =  $_POST['title'];

			$headerData['showLogin'] = FALSE;

			if ($this->form_validation->run() === FALSE)
			{
				header('HTTP/2 401 Invalid parameters');
				die(json_encode(array('message' => 'INVALID PARAMETERS')));
			}
			else
			{
				$sellerEmail = $_SESSION['user_id']; 
				$idCreated = $this->item_model->addItem($sellerEmail);
				echo 'HTTP/2 201';
			}
		}

		public function manage() {
			$this->load->view('header', $this->headerData);
			$this->load->view('manage_item_page');
		}

		// endpoint for getItemsOwnedByCurrentUser
		public function getCurr() {
			echo $this->getItemsOwnedByCurrentUser();
		}

		// endpoint for remove
		public function removeItem() {
			echo $this->remove($_POST['id']);
		}

		public function editItem()
		{
			echo $this->edit();
		}

		// returns a JSON string
		private function getItemsOwnedByCurrentUser()
		{
			$sellerEmail = $_SESSION['user_id']; 
			$items = $this->item_model->getItemsBySeller($sellerEmail);
			return $items;
		}

		private function remove($id)
		{
			$success = $this->item_model->removeItem($id);
			if ($success)
			{
				echo "HTTP/2 201";
			}
			else
			{
				header('HTTP/2 <enter code> Invalid Item');
				die(json_encode(array('message' => 'Invalid Item')));
			}
		}

		private function edit()
		{
			$success = $this->item_model->editItem();
			if ($success)
			{
				echo "HTTP/2 201";
			}
			else
			{
				header('HTTP/2 <enter code> Invalid Item');
				die(json_encode(array('message' => 'Invalid Item')));
			}

		}

	}
?>