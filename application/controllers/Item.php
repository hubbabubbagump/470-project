<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Item extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('item_model');

			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->helper('url');
			// load view of form?
			//$this->load->view('add_item_page')
		}

		public function create()
		{
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('sellerID', 'Seller ID', 'required');
			$this->form_validation->set_rules('price', 'Price', 'decimal');
			$data['title'] = "Add a new item to sell";

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('header', $data); //which header?
				$this->load->view('add_item'); 
			}
			else
			{
				$this->item_model->addItem();
				echo 'Successfully added new item';
				$this->item_model->getItemSummary();
			}
		}
	}
?>