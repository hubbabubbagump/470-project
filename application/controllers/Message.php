<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Message extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			if(session_id() == '' || !isset($_SESSION)) {
				// session isn't started
				session_start();
			}

			$this->load->model('message_model');
		}

		
		public function index() 
		{
			parent::__construct();
			//session_start();

			if(isset($_SESSION['user_id'])) {
				$headerData['showLogin'] = FALSE;
				$headerData['showPostItem'] = TRUE;
				
				$this->load->model('message_model');
				$this->load->view('header', $headerData);
				$this->load->view('messages_page');
				$this->load->view('footer');
			}
		}

		public function send()
		{
			$headerData['showLogin'] = FALSE;
            $senderEmail = $_SESSION['user_id'];
            $messageID = $this->message_model->send($senderEmail); 
		}

		public function retrieve()
		{
            $senderEmail = $_SESSION['user_id'];
			$conversation = $this->message_model->retrieve($senderEmail); 
			echo $conversation;
		}

		public function get()
		{
            $senderEmail = $_SESSION['user_id'];
			$participants = $this->message_model->get($senderEmail); 
			echo $participants;
		}

		public function markRead()
		{
			$success = $this->message_model->setReadStatus();
			echo $success;
		}
	}
?>