<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Logout extends CI_Controller {
        public function __construct() {
            parent::__construct();

            session_start();

            session_destroy();
            header("Location: /");
        }

        public function index() {

        }
    }
?>
