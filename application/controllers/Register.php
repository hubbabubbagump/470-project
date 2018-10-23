<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->model('register_model', 'reg_model');
        $this->load->view('register_page');
    }

    public function index() {

    }
    
    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            header("Location: /register");
        }
        else {
            $this->reg_model->add_user();
            header("Location: /welcome");
        }
    }
}
