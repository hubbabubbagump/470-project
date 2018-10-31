<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    require_once DATABASE . "settings.php";
    require_once DATABASE . "userManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once DATABASE . "itemManagement.php";

    class Item_model extends CI_model
    {

    	public function __construct()
    	{
    		parent::__construct();
    	}

    	public function addItem($sellerID): string
    	{
    		$database = new MongoDB\Client(getDBAddr());
            return insertItem(
                 $database->local->saleItems
                ,$_POST['title']
                ,$sellerID
                ,$_POST['faculty']
                ,$_POST['courseNum']
                ,$_POST['desc']
                ,$_POST['price']);
    	}

    	public function removeItem()
    	{

    	}

    	public function getItemDetailsById($id)
    	{
             $database = new MongoDB\Client(getDBAddr());
            return getItemById($database->local->saleItems, $id);

    	}
    	
    	public function getItemDetailed()
    	{

    	}

    	public function getAllItems()
    	{

    	}
    }

?>