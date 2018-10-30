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
				$this->load->model('item_model');

				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->load->helper('url');
				// load view of form

				$this->load->view('header', $headerData);
				$this->load->view('add_item_page');
		}

		}
		   public function index() {

    }
    

		public function create()
		{
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('sellerID', 'Seller ID', 'required');
			$this->form_validation->set_rules('price', 'Price', 'decimal');
			$data['title'] =  $item_model->input->post('title');// "Add a new item to sell";

			if ($this->form_validation->run() === FALSE)
			{
				echo "form validation failed";
				echo "title: ".$title;

				$headerData['showLogin'] = FALSE;
				$this->load->view('header', $headerData); //which header?
				$this->load->view('add_item_page');//, $data); 
			}
			else
			{	
				$sellerID = $_SESSION['user_id'];
				$this->item_model->addItem($sellerID);
				//echo 'Successfully added new item';
				//$this->item_model->getItemSummary();
				$this->load->view('add_item_success_page', $data);
			}
		}
	}
?>