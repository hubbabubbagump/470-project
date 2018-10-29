<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $showLogin = TRUE;

	public function __construct() {
        parent::__construct();
        session_start();

        if (isset($_SESSION['user_id'])) {
            header("Location: /");
        }
        else {
            $email = "";

            $headerData['showLogin'] = $this->showLogin;
            $data['email'] = $email;

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->helper('url');

            $this->load->model('login_model');
            $this->load->view('header', $headerData);
            $this->load->view('login_page', $data);

        }
    }

    public function index() {

    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            header('HTTP/1.1 401 Invalid parameters');
            die(json_encode(array('message' => 'INVALID PARAMETERS')));
        }
        else {
            $email = $this->input->post('email');
            $pw = $this->input->post('password');
            $result = $this->login_model->login($email, $pw);

            if (!$result) {
                header('HTTP/1.1 401 Invalid email or password');
                die(json_encode(array('message' => 'INVALID CREDENTIALS')));
            }
            else {
                echo 'HTTP/2 201';
            }
        }
    }
}
