'use strict';

var request;

function getItems() {
	var textArea = document.getElementById("text");

	if (request) {
		request.abort();
	}

	request = $.ajax({
		url: "/index.php/search/getItems",
		type: "post",
		data: {
			courseNum: 470
		}
	});

	request.done( function(response, textStatus, jqXHR) {
		textArea.innerHTML = response;
	});

	request.fail( function(jqXHR, textStatus, errorThrown) {
		textArea.innerHTML = errorThrown;
	});
}