var request;

$(document).ready(function() {
	getItems();
});

function getItems() {
	var infoSection = document.getElementById("info");

	if (request) {
		request.abort();
	}

	request = $.ajax({
		url: "/index.php/Item/getCurr",
		type: "post"
	});

	request.done(function(response, textStatus, jqXHR) {
		var items = JSON.parse(response);

		if ($.isEmptyObject(items)) {
			infoSection.style.display = "block";
		} else {
			for (var key in items) {
				createItemSection(items[key]);
			}
		}
		
	});

	request.fail( function(jqXHR, textStatus, errorThrown) {
		// fix later
		infoSection.innerHTML = errorThrown;
	});
}

function createItemSection(item) {
	var itemDiv = document.getElementById("items");

	var container = document.createElement("div");
	container.className = "itemContainer";
	container.id = item._id;

	var title = document.createElement("div");
	title.className = "itemTitle";
	title.innerHTML = item.title;

	var date = document.createElement("div");
	date.className = "itemDatePosted";
	date.innerHTML = convertUNIXtoDateString(item.datePosted);

	var course = document.createElement("div");
	course.className = "itemCourse";
	course.innerHTML = item.faculty + item.courseNum;

	// you can add other information here

	var deleteButton = document.createElement("input");
	deleteButton.type = "button";
	deleteButton.value = "Delete This Item";
	deleteButton.onclick = sendDelete.bind(item._id);

	container.appendChild(title);
	container.appendChild(date);
	container.appendChild(course);
	container.appendChild(deleteButton);

	itemDiv.appendChild(container);
}

function sendDelete() {
	var infoSection = document.getElementById("info");

	if (request) {
		request.abort();
	}

	request = $.ajax({
		url: "/index.php/Item/removeItem",
		type: "post",
		data: {
			id: this.toString()
		}
	});

	request.done(function(response, textStatus, jqXHR) {
		showPopup();
		$("#"+this.toString()).remove();
	}.bind(this));

	request.fail(function(jqXHR, textStatus, errorThrown) {
		// fix later
		infoSection.innerHTML = errorThrown;
	});
}

function convertUNIXtoDateString(timestamp) {
	var months_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var date = new Date(timestamp);

	var month = months_arr[date.getMonth()];
	var day = date.getDate();
	var year = date.getFullYear();
	var hours = date.getHours();
	var minutes = "0" + date.getMinutes();
	var seconds = "0" + date.getSeconds();

	return month+' '+day+', '+year+' '+hours+ ':' +minutes.substr(-2) + ':' + seconds.substr(-2);
}

function showPopup() {
	$('<div>Deleted Successfully!</div>').insertBefore('#info').delay(3000).fadeOut();
}