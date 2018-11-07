var request;

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function addItem() {
	var form = document.forms["addItemForm"];
	var body = document.getElementById("formbody");
	var errorStr = document.getElementById("error");

	if (isEmpty(form['title'].value) ||
		isEmpty(form['price'].value) ||
		isEmpty(form['faculty'].value) ||
		isEmpty(form['courseNum'].value))
	{
		errorStr.innerText = "* Please fill in all boxes";
		return false;
	}

	if (request) {
		request.abort();
	}

	errorStr.innerText = "";

	request = $.ajax({
		url: "/index.php/item/create",
		type: "post",
		data: {
			 title: form['title'].value
			,price: form['price'].value
			,faculty: form['faculty'].value
			,courseNum: form['courseNum'].value
			,desc: form['desc'].value
		}
	});

	request.done(function (response){
		window.location.href = "/"; //change to show post
		alert("Item created")
		//form.style.visibility = "hidden";
		//$("#formbody").html(response);
		//location.replace("/add_item_sucess_page");
		// $("html").html(response);
		//$("html").innerText = response;
		//$("html").html($("html", response).html()); 
	});

	request.fail(function (jqXHR, textStatus, errorThrown) {
		window.alert("Error: " + textStatus, errorThrown);
	});

	return false;
}