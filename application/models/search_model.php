<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    require_once DATABASE . "settings.php";
    require_once DATABASE . "itemManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';

    class Search_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getItems($courseNum) {
            $database = new MongoDB\Client(getDBAddr());

            return getItemsByCourseNum($database->local->saleItems, $courseNum);
        }
    }

?>