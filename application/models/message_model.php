<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    require_once DATABASE . "settings.php";
    //require_once DATABASE . "userManagement.php";
    require_once __DIR__ . '/../vendor/autoload.php';
	require_once DATABASE . "messageManagement.php";
	//require_once DATABASE . "userManagement.php";

    class Message_model extends CI_model
    {

    	public function __construct()
    	{
    		parent::__construct();
    	}

    	public function send($senderEmail): string
    	{
			$database = new MongoDB\Client(getDBAddr());
            return sendMessage(
                $database->local->messages,
                $senderEmail,
                $_POST['recipient'],
                $_POST['body']
            );
    	}

    	public function retrieve($senderEmail): string
    	{
			$database = new MongoDB\Client(getDBAddr());
            return retrieveMessage(
                $database->local->messages,
                $senderEmail,
                $_GET['recipient']
			);
		}
		
		public function get($senderEmail): string
    	{
			$database = new MongoDB\Client(getDBAddr());
            return getParticipants(
                $database->local->messages,
                $senderEmail
			);
		}
    }

?>