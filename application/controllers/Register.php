<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    private $showLogin = TRUE;

	public function __construct() {
        parent::__construct();
        session_start();

        if (isset($_SESSION['user_id'])) {
            header("Location: /");
        }
        else {
            $email = "";
            $name = "";

            $headerData["showLogin"] = $this->showLogin;
            $data['email'] = $email;
            $data['name'] = $name;

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->helper('url');
    
            $this->load->model('register_model', 'reg_model');
            $this->load->model('login_model');
            $this->load->view('header', $headerData);
            $this->load->view('register_page', $data);
        }
    }

    public function index() {

    }
    
    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            header('HTTP/1.1 401 Invalid parameters');
            die(json_encode(array('message' => 'INVALID PARAMETERS')));
        }
        else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $pw = $this->input->post('password');

            $result = $this->reg_model->add_user($name, $email, $pw);
            if (!$result) {
                header('HTTP/2 401 Invalid email');
                die(json_encode(array('message' => 'EMAIL IN USE')));
            }
            else {
                $this->login_model->login($email, $pw);
                echo 'HTTP/2 201';
            }
        }
    }
}
