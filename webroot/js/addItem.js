var request;

function addItem() {
	var form = document.forms["addItemForm"];
	if (request) {
		request.abort();
	}

	// get user info from header?
	// or from previous page?
	var sellerID = "";
	window.alert("sending request to create new item");
	request = $.ajax({
		url: "/index.php/Item/create",
		type: "post",
		data: {
			 title: form['title'].value
			,price: form['price'].value
			,faculty: form['faculty'].value
			,courseNum: form['courseNum'].value
			,desc: form['desc'].value
			,sellerID: sellerID
		}
	});

	request.done(function (response, textStatus, jqXHR /*??*/){
		window.location.href = "/login"; //change to show post
		window.alert("request successful!");
	});

	request.fail(function (jqXHR, textStatus, errorThrown) {
		window.alert("Error: " + textStatus, errorThrown);
	});

	return false;
}