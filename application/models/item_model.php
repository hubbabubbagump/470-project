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

    	public function addItem($sellerID)
    	{
    		$this->load->helper('url');
    		//$slug = url_title($this->input->post('title'), 'dash', TRUE);

    		// need to check that all values ara valid?- should be done in controller

    		// need to create a new db client? confirm on discord
    		$database = new MongoDB\Client(getDBAddr());

    		addItem(
    			 $database->local->saleItems
    			,$this->input->post('title')
    			,$sellerID
    			,$this->input->post('faculty')
    			,$this->input->post('courseNum')
    			,$this->input->post('desc')
    			,$this->input->post('price'));
    	}

    	public function removeItem()
    	{

    	}

    	public function getItemSummary()
    	{

    	}
    	
    	public function getItemDetailed()
    	{

    	}

    	public function getAllItems()
    	{

    	}
    }

?>