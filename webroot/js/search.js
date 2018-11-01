'use strict';

var request;

function getItems() {
	var form = document.forms["searchForm"];
	var textArea = document.getElementById("text");

	if (request) {
		request.abort();
	}

	request = $.ajax({
		url: "/index.php/search/getItems",
		type: "post",
		data: {
			//courseNum: form['courseNum'].value,
			title: form['title'].value,
			faculty: form['faculty'].value,
		}
	});

	request.done(function(response, textStatus, jqXHR) {
		var data = convertRawResponse(response);

		clearTable();
		for (var key in data) {
			createResultRow(data[key]);
		}
	});

	request.fail( function(jqXHR, textStatus, errorThrown) {
		textArea.innerHTML = errorThrown;
	});
}

function convertRawResponse(response) {
	return JSON.parse(response);
}

function createResultRow(entry) {
	var table = document.getElementById("resultsTable");
	var row = table.insertRow(1);

	// there has to be a better way to do this ...
	var cTitle = row.insertCell(0);
	cTitle.innerHTML = entry.title;

	var cFaculty = row.insertCell(1);
	cFaculty.innerHTML = entry.faculty;

	var cCourseNum = row.insertCell(2);
	cCourseNum.innerHTML = entry.courseNum;

	var cDesc = row.insertCell(3);
	cDesc.innerHTML = entry.desc;

	var cDate = row.insertCell(4);
	cDate.innerHTML = entry.datePosted;

	var cSeller = row.insertCell(5);
	cSeller.innerHTML = entry.seller;

	var cPrice = row.insertCell(6);
	cPrice.innerHTML = entry.price;
}

function clearTable() {
	$("#resultsTable thead td").remove();
}