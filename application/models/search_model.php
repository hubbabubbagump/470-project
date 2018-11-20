<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require_once DATABASE . "settings.php";
    require_once DATABASE . "itemManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';

    class Search_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }
        
        public function searchByIndex($text, $page) {
            $database = new MongoDB\Client(getDBAddr());
            return getItemsByIndex($database->local->saleItems, $text, $page);
        }

        public function getNewest($page) {
            $database = new MongoDB\Client(getDBAddr());
            return getNewestItems($database->local->saleItems, $page);
        }

        public function getById($id) {
            $database = new MongoDB\Client(getDBAddr());
            return getItemById($database->local->saleItems, $id);
        }
    }

?>