'use strict';

var participants;
var conversation;
var targetEmail;

debugger;

function getContacts() {
	var list = [];

    participants = $.ajax({
		url: "/index.php/message/get",
		type: "get"
		});
    
    participants.done(function(response, textStatus, jqXHR) {
		var jsonData = convertRawResponse(response);

		if ($.isEmptyObject(jsonData)) {
			document.getElementById("test").innerHTML = "<h2>No previous messages detected<h2>";
		} else {
			document.getElementById("test").innerHTML = "";
			document.getElementById("dropMenu").innerHTML = "";
            
			for (var i = 0; i < jsonData.participants.length; i++) {
    			var contacts = jsonData.participants[i];
				//console.log(contacts.recipientEmail);
				
				if (contacts.hasOwnProperty('recipientEmail')) {
					if ($.inArray(contacts.recipientEmail, list) == -1) {
						list.push(contacts.recipientEmail);
						$( ".dropdown-content" ).append("<a class=\"contact\" onclick=\"getMessages(\'" + contacts.recipientEmail + "\')\" value=\" " + contacts.recipientEmail + " \">" + contacts.recipientEmail + "</a>");
					}
				} else {
					if ($.inArray(contacts.senderEmail, list) == -1) {
						list.push(contacts.senderEmail);
						$( ".dropdown-content" ).append("<a class=\"contact\" onclick=\"getMessages(\'" + contacts.senderEmail + "\')\" value=\" " + contacts.senderEmail + " \">" + contacts.senderEmail + "</a>");
					}	
				}
			}
		}
    });
    
    participants.fail( function(jqXHR, textStatus, errorThrown) {
		document.getElementById("test").innerHTML = errorThrown;
	});
}

function getMessages(email) {

	targetEmail = email;

	conversation = $.ajax({
        url: "/index.php/message/retrieve",
        type: "get",
        data: {
            recipient: targetEmail
        }
	});

	conversation.done(function(response, textStatus, jqXHR) {
		var jsonData = convertRawResponse(response);
		document.getElementById("message").innerHTML = "";

		for (var i = 0; i < jsonData.conversation.length; i++) {
			var conversations = jsonData.conversation[i];
			
			$( ".messageDisplay" ).append("<h3>From: " + conversations.senderEmail + "\n<h3>");
			$( ".messageDisplay" ).append("<h3>To: " + conversations.recipientEmail + "\n<h3>");
			$( ".messageDisplay" ).append("Message: " + conversations.message + "\n");
			$( ".messageDisplay" ).append("\n");
		}
    });
    
    conversation.fail( function(jqXHR, textStatus, errorThrown) {
		document.getElementById("test").innerHTML = errorThrown;
	});

}

var messageSendRequest;

function sendMessage() {
    var message = document.getElementById("textarea").value;

    messageSendRequest = $.ajax({
        url: "/index.php/message/send",
        type: "post",
        data: {
            recipient: targetEmail,
            body: message
        }
	});
	
	getMessages(targetEmail);

	document.getElementById("textarea").value = "";
    //console.log(recieverEmail);
}

function convertRawResponse(response) {
	return JSON.parse(response);
}