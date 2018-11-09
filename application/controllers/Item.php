<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Item extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			session_start();

			if(isset($_SESSION['user_id'])) {
				$headerData['showLogin'] = FALSE;
				$headerData['showPostItem'] = FALSE;
				
				$this->load->model('item_model');

				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->helper('url');
				// load view of form
				$this->load->view('header', $headerData);
				$this->load->view('add_item_page');
			}
		}
		
		public function index() 
		{}
    

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

		public function getItemsOwnedByCurrentUser()
		{
			$sellerEmail = $_SESSION['user_id']; 
			$items = $this->item_model->getItemsBySeller($sellerEmail);
			echo $items;
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




	}
?>