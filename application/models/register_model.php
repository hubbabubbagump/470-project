<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require_once DATABASE . "settings.php";
    require_once DATABASE . "userManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';

    class Register_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function add_user(string $name, string $email, string $pw) {
            $database = new MongoDB\Client(getDBAddr());
 
            return insertUser($database->local->users, $name, $email, $pw, False);
        }
    }

?>