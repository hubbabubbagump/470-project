'use strict';

var participants;
var conversation;
var targetEmail;

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
		if (jsonData.conversation) {
			if (jsonData.conversation[0].recipientEmail == currentUser) {
				document.getElementById("conversationTitle").innerHTML = jsonData.conversation[0].senderEmail;
			} else {
				document.getElementById("conversationTitle").innerHTML = jsonData.conversation[0].recipientEmail;
			}
		} else {
			document.getElementById("conversationTitle").innerHTML = "";
		}

		for (var i = 0; i < jsonData.conversation.length; i++) {
			var conversations = jsonData.conversation[i];
			
			createMessageSection(conversations);
		}

		$(".messageDisplay").scrollTop($(".messageDisplay")[0].scrollHeight);
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

function createMessageSection(conversation) {
	var section = document.getElementsByClassName("messageDisplay")[0];

	/*var container = document.createElement("div");
	container.className = "msgContainer";

	var sender = document.createElement("div");
	sender.className = "msgSenderEmail";
	sender.innerHTML = conversation.senderEmail;

	var recipient = document.createElement("div");
	recipient.className = "msgRecipientEmail";
	recipient.innerHTML = conversation.recipientEmail;*/
	
	var message = document.createElement("p");
	if (conversation.senderEmail == currentUser) {
		message.className = "msgFromYou";
	} else {
		message.className = "msgFromOther";
	}
	message.innerHTML = conversation.message;

	/*container.appendChild(sender);
	container.appendChild(recipient);
	container.appendChild(message);*/

	section.appendChild(message);
}

function convertRawResponse(response) {
	return JSON.parse(response);
}