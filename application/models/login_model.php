<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require_once DATABASE . "settings.php";
    require_once DATABASE . "userManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';

    class Login_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function login(string $email, string $pw):bool {
            $database = new MongoDB\Client(getDBAddr());

            $result = verifyUser($database->local->users, $email, $pw);

            if ($result) {
                $_SESSION['user_id'] = $email;
            }
            return $result;
        }
    }

?>