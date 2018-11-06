<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require_once DATABASE . "settings.php";
    require_once DATABASE . "itemManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';

    class Search_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getItemsFromDB($filter) {
            $database = new MongoDB\Client(getDBAddr());

            return getItemsByQuery($database->local->saleItems, $filter);
        }

        public function searchByIndex($text) {
            $database = new MongoDB\Client(getDBAddr());
            return getItemsByIndex($database->local->saleItems, $text);
        }
    }

?>