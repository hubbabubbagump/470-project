<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$session_value = (isset($_SESSION['user_id']))?$_SESSION['user_id']:'';
?><!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Messages</title>

		<link rel="stylesheet" href="/css/header.css">
		<link rel="stylesheet" href="/css/login.css">
		<link rel="stylesheet" href="/css/message.css">

		<!--<script src="/js/jquery-3.3.1.min.js"></script>
		<script type='text/javascript' src="/js/header.js"></script>
		<script type='text/javascript' src="/js/messages.js"></script>
		<script><link rel="stylesheet" href="/css/login.css"></script>
		<link rel="stylesheet" href="/css/header.css">-->
		<script type="text/javascript">
		var currentUser = '<?php echo $session_value;?>';
		</script>
	</head>
	
	<body class="loginContainer" onload="getContacts()">

  		<h1>Messages</h1>
  		<div class="messagesBody">
			<div id="test">
			</div>

			<div id="conversationTitle"></div>

			<div class="contacts">
				<div class="contactsTitle">Contacts</div>
			</div>

			<div class="messageDisplay" id="message"></div>

			<div id="newMessage" class="modal">
				<div id="newMessageContent" class="modalContent">
					<div id="messageBody" class="modalBody">
						<textarea id="textarea" rows="10" cols="73" name="message" autofocus required></textarea>
						<br>
						<input id="messageButton" class="button" type="submit" value="Send Message" onclick="sendMessage()"></input>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/messages.js"></script>
	<script type='text/javascript' src="/js/header.js"></script>
	
</html>
