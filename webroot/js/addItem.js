var request;

var leafletMap;
var leaftletMarker;

$(document).ready(function() {
	if (sessionStorage.getItem("addItemPopup")) {
		showPopup("Item Posted!");
		sessionStorage.removeItem("addItemPopup");
	}
    leafletMap = L.map('addItemMap').setView([49.276184, -122.918719], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGp0dW5nIiwiYSI6ImNqb2diY3U0NDA3N2UzcG1nejZmcnBnemMifQ.pvJl8iZLM--Cf2NqKNAVzA', 
    {
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiZGp0dW5nIiwiYSI6ImNqb2diY3U0NDA3N2UzcG1nejZmcnBnemMifQ.pvJl8iZLM--Cf2NqKNAVzA'
    }).addTo(leafletMap);

    leafletMarker = L.marker([49.276184, -122.918719]).addTo(leafletMap);

    leafletMap.on('click', function(event) {
    	leafletMarker.setLatLng(event.latlng);
    });
});

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
			title: form['title'].value,
			price: form['price'].value,
			faculty: form['faculty'].value,
			courseNum: form['courseNum'].value,
			desc: form['desc'].value,
			imgs: imageUrls,
			// mongoDB stores geo coordinates as long, lat so we have to reverse it here
			location: leafletMarker.toGeoJSON().geometry.coordinates.reverse()
		}
	});

	request.done(function (response){
		sessionStorage.setItem("addItemPopup", true);
		location.reload();
	});

	request.fail(function (jqXHR, textStatus, errorThrown) {
		console.log("Error: " + textStatus, errorThrown);
	});

	return false;
}

var imageUrls = [];

cloudinary.applyUploadWidget('#imageWidget', {
		cloudName: 'dkgnnu4oh', 
		uploadPreset: 'preset1', 
		sources: ['local'],
		buttonClass: 'imageButton'
	},
	(error, result) => {
		if (result && result.event === "success") {
			imageUrls.push(result.info.url);
		}
	}
)
