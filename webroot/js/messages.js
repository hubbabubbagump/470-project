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
            
			for (var i = 0; i < jsonData.participants.length; i++) {
    			var contacts = jsonData.participants[i];
				//console.log(contacts.recipientEmail);
				
				if (contacts.hasOwnProperty('recipientEmail')) {
					if ($.inArray(contacts.recipientEmail, list) == -1 && contacts.recipientEmail) {
						list.push(contacts.recipientEmail);
						createContactSection(contacts.recipientEmail);
					}
				} else {
					if ($.inArray(contacts.senderEmail, list) == -1 && contacts.senderEmail) {
						list.push(contacts.senderEmail);
						createContactSection(contacts.senderEmail);						
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
            recipient: email
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

function createContactSection(contactEmail) {
	//$( ".dropdown-content" ).append("<a class=\"contact\" onclick=\"getMessages(\'" + contacts.senderEmail + "\')\" value=\" " + contacts.senderEmail + " \">" + contacts.senderEmail + "</a>");

	var section = document.getElementsByClassName("contacts")[0];
	
	var contact = document.createElement("p");
	contact.className = "contactListing";
	contact.innerHTML = contactEmail;
	contact.onclick = function() {
		getMessages(this);
	}.bind(contactEmail);

	section.appendChild(contact);
}

function createMessageSection(conversation) {
	var section = document.getElementsByClassName("messageDisplay")[0];
	
	var message = document.createElement("p");
	if (conversation.senderEmail == currentUser) {
			message.className = "msgFromYou";
	}
	else {
		if (conversation.readStatus == false) {
			message.className = "msgFromOther";
			message.style.fontWeight = 'bold';
			message.style['background-color'] = '#e3e3e3';
			message.id = conversation._id;
			message.onmouseover = setReadStatus.bind(conversation._id);
		}
		else {
			message.className = "msgFromOther";
		}
	}
	message.innerHTML = conversation.message;

	section.appendChild(message);
}

var setReadRequest;

function setReadStatus() {
	//send ajax call to set read 
	var message = document.getElementById(this.toString());
	
	if (message != undefined) {
		
		if (setReadRequest) {
		setReadRequest.abort();
		}

		setReadRequest = $.ajax({
			url: "/index.php/message/markRead",
			type: "post",
			data: {
				id: this.toString()
			}
		});

		setReadRequest.done(function(response) {
			message.style.fontWeight = 'normal';
			message.style['background-color'] = '#DCDCDC';
			message.id = message.id+'-';
		});

		setReadRequest.fail(function(jqXHR, textStatus, errorThrown) {
			window.alert(errorThrown);
		});
	}
}

function convertRawResponse(response) {
	return JSON.parse(response);
}