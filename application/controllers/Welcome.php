<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	private $showLogin = TRUE;

	public function index()
	{
		session_start();
	
		if (isset($_SESSION['user_id'])) {
            $this->showLogin = FALSE;
			$headerData['showPostItem'] = TRUE;
		}
		else {
			$headerData['showPostItem'] = FALSE;
		}

		$headerData['showLogin'] = $this->showLogin;
		$test = $this->showLogin;
		$this->load->view('header', $headerData);
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
}
