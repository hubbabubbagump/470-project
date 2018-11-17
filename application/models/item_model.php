<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    require_once DATABASE . "settings.php";
    require_once DATABASE . "userManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';
	require_once DATABASE . "itemManagement.php";
	require_once DATABASE . "userManagement.php";

    class Item_model extends CI_model
    {

    	public function __construct()
    	{
    		parent::__construct();
    	}

    	public function addItem($sellerEmail): string
    	{
			$database = new MongoDB\Client(getDBAddr());
			$name = getUserName($database->local->users, $sellerEmail);
            return insertItem(
                $database->local->saleItems,
                $_POST['title'],
                $sellerEmail,
                $name,
                $_POST['faculty'],
                $_POST['courseNum'],
                $_POST['desc'],
                $_POST['price'],
				$_POST['location'],
				$_POST['imgs']
            );
    	}

    	public function removeItem($id)
    	{
            $database = new MongoDB\Client(getDBAddr());
            return removeItemById(
                 $database->local->saleItems
                ,$id);
    	}

    	public function getItemDetailsById($id)
    	{
            $database = new MongoDB\Client(getDBAddr());
            return getItemById($database->local->saleItems, $id);

    	}
    	
    	public function getItemsBySeller($sellerEmail)
    	{
            $database = new MongoDB\Client(getDBAddr());
            return getItemsBySellerEmail(
                 $database->local->saleItems
                ,$sellerEmail);
    	}

    	public function getAllItems()
    	{

    	}
    }

?>