<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->model('login_model');
        $this->load->view('header');
        $this->load->view('login_page');
    }

    public function index() {

    }
    
    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            header("Location: /login");
        }
        else {
            $this->login_model->login();
            header("Location: /welcome");
        }
    }
}
