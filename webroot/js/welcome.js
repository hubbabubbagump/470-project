'user strict'

var searchBox = document.getElementById("searchBox");
searchBox.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        getItems();
    }
});

window.onclick = function(event) {
    if (event.target == document.getElementById("modal")) {
        document.getElementById("modal").style.display = "none";
    }

    if (event.target == document.getElementById("msgModal")) {
        document.getElementById("msgModal").style.display = "none";
    }
}

var searchRequest;
var page = 1;
var queryText;
var leafletMap;
var leafletMarker;

function getItems() {
    var searchBox = document.getElementById("searchBox");
    var text = searchBox.value;
    if (!text || text == "") {
        return;
    }

    if (searchRequest && queryText && queryText == text) {
        return;
    }
    else if (searchRequest && queryText && queryText != text) {
        searchRequest.abort();
    }

    page = 1;

    var searchText = document.getElementById("searchText");
    searchText.style.display = "none";
    $(".loaderDiv").addClass("loading");

    queryText = text;

    searchRequest = $.ajax({
        url: "/index.php/search/search",
        type: "get",
        data: {search: text, page: page}
    });

    searchRequest.done(function (response, textStatus, jqXHR) {
        var jsonResponse = JSON.parse(response);
        var results = jsonResponse.results;
        var moreItems = jsonResponse.moreItems;
        var loggedIn = jsonResponse.isAuthenticated;

        var container = document.getElementById("itemList");
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }

        if (results === undefined || results.length == 0) {
            document.getElementById("noItems").style.display = "block";
            document.getElementById("getMore").style.display = "none";
        }
        else {
            document.getElementById("noItems").style.display = "none";
            var header = document.createElement("h1");
            header.innerText = "Results"
            container.appendChild(header);

            for (var i in results) {
                if (results.hasOwnProperty(i)) {
                    let item = results[i];
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    renderItem(item, container, bColor, loggedIn);
                }
            }
            
            var getMore = document.getElementById("getMore");
            if (moreItems) {
                getMore.style.display = "block";
            }
            else {
                getMore.style.display = "none";
            }
        }
    });

    searchRequest.fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
    });

    searchRequest.always(function(jqXHR, textStatus){
        document.getElementById("loader").style.display = "none";
        searchText.style.display = "block";
        $(".loaderDiv").removeClass("loading");
    });
}

function getMore() {
    var url = "/index.php/search/search";
    if (!queryText) {
        url = "/index.php/search/new";
    }
    else if (searchRequest) {
        searchRequest.abort();
    }

    page += 1;
    document.getElementById("moreText").style.display = "none";
    $(".loaderDivMore").addClass("loading");

    searchRequest = $.ajax({
        url: url,
        type: "get",
        data: {search: queryText, page: page}
    });

    searchRequest.done(function (response, textStatus, jqXHR) {
        var jsonResponse = JSON.parse(response);
        var results = jsonResponse.results;
        var moreItems = jsonResponse.moreItems;
        var loggedIn = jsonResponse.isAuthenticated;

        var container = document.getElementById("itemList");

        if (results === undefined || results.length == 0) {
            document.getElementById("getMore").style.display = "none";
        }
        else {
            for (var i in results) {
                if (results.hasOwnProperty(i)) {
                    let item = results[i];
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    renderItem(item, container, bColor, loggedIn);
                }
            }
            
            var getMore = document.getElementById("getMore");
            if (moreItems) {
                getMore.style.display = "block";
            }
            else {
                getMore.style.display = "none";
            }
        }
    });

    searchRequest.fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
    });

    searchRequest.always(function(jqXHR, textStatus) {
        document.getElementById("loader").style.display = "none";
        $(".loaderDivMore").removeClass("loading");
        document.getElementById("moreText").style.display = "block";
    })
}

function getNewItems() {
    if (searchRequest) {
        searchRequest.abort();
    }

    page = 1;

    searchRequest = $.ajax({
        url:  "/index.php/search/new",
        type: "get",
        data: {page: page}
    });

    searchRequest.done(function (response, textStatus, jqXHR) {
        var jsonResponse = JSON.parse(response);
        var results = jsonResponse.results;
        var moreItems = jsonResponse.moreItems;
        var loggedIn = jsonResponse.isAuthenticated;

        var container = document.getElementById("itemList");

        if (results === undefined || results.length == 0) {
            document.getElementById("noItems").style.display = "block";
            document.getElementById("getMore").style.display = "none";
        }
        else {
            document.getElementById("noItems").style.display = "none";

            document.getElementById("noItems").style.display = "none";
            var header = document.createElement("h1");
            header.innerText = "New Items";
            container.appendChild(header);

            for (var i in results) {
                if (results.hasOwnProperty(i)) {
                    let item = results[i];
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    renderItem(item, container, bColor, loggedIn);
                }
            }
            
            var getMore = document.getElementById("getMore");
            if (moreItems) {
                getMore.style.display = "block";
            }
            else {
                getMore.style.display = "none";
            }
        }
    });

    searchRequest.fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
    });

    searchRequest.always(function(jqXHR, textStatus) {
        document.getElementById("loader").style.display = "none";
        $(".loaderDivMore").removeClass("loading");
        document.getElementById("moreText").style.display = "block";
    })
}

function renderItem(item, container, bColor, loggedIn) {
    var div = document.createElement("div");
    div.style.backgroundColor = bColor;
    div.className = "itemBox";
    div.id = item._id;

    if (loggedIn) {
        var msgBox = document.createElement("div");
        msgBox.className = "msgBox";
        msgBox.innerText = "Message";
    }

    var title = document.createElement("p");
    title.innerText = item.title;
    title.className = "title";

    var course = document.createElement("p");
    course.innerText = item.faculty + " " + item.courseNum;
    course.className = "course";

    var price = document.createElement("p");
    price.innerText = "$" + parseFloat(item.price).toFixed(2);
    price.className = "price";

    var description = document.createElement("p");
    description.innerText = item.desc;
    description.className = "desc";

    if (loggedIn) {
        div.appendChild(msgBox);
    }
    div.appendChild(title);
    div.appendChild(course);
    div.appendChild(price);
    container.appendChild(div);

    title.addEventListener("click", function() {
        openModal(item._id);
    });

    if (loggedIn) {
        msgBox.addEventListener("click", function() {
            openMessageModal(item.sellerEmail, item._id);
        });
    }
}

var itemRequest;

function openModal(id) {
    if (itemRequest) {
        itemRequest.abort();
    }

    itemRequest = $.ajax({
        url:  "/index.php/search/id",
        type: "get",
        data: {id: id}
    });

    itemRequest.done(function (response, textStatus, jqXHR) {
        if (response) {
            var item = JSON.parse(response);
            var modalHeader = document.getElementById("modalTitle");
            modalHeader.innerText = item.title;

            var seller = document.getElementById("modalSeller");
            seller.innerText = "Seller: " + item.sellerName;

            var course = document.getElementById("modalCourse");
            course.innerText = "Course: " + item.faculty + " " + item.courseNum;

            var price = document.getElementById("modalPrice");
            price.innerText = "Price: $" + parseFloat(item.price).toFixed(2);
            
            var desc = document.getElementById("modalDesc");
            desc.innerText = item.desc;

            if (!leafletMap) {
                leafletMap = L.map('itemResultMap').setView(item.location, 13);

                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGp0dW5nIiwiYSI6ImNqb2diY3U0NDA3N2UzcG1nejZmcnBnemMifQ.pvJl8iZLM--Cf2NqKNAVzA', 
                {
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: 'pk.eyJ1IjoiZGp0dW5nIiwiYSI6ImNqb2diY3U0NDA3N2UzcG1nejZmcnBnemMifQ.pvJl8iZLM--Cf2NqKNAVzA'
                }).addTo(leafletMap);

                leafletMarker = L.marker(item.location).addTo(leafletMap);
            } else {
                leafletMap.setView(item.location, 13);
                leafletMarker.setLatLng(item.location);
            }

            document.getElementById("modal").style.display = "block";

            // have to do this after the modal is rendered
            if (leafletMap) {
                leafletMap.invalidateSize();
            }
        }
        else {
            alert("Invalid item id");
        }
    });

    itemRequest.fail(function(jqXHR, textStatus, errorThrown) {
    });
}

var currentEmail;
var currentId;

function openMessageModal(email, id) {
    if (id != currentId) {
        document.getElementById("textarea").value = "";
    }
    currentEmail = email;
    currentId = id;
    var msgModal = document.getElementById("msgModal");
    msgModal.style.display = "block";
}

function sendMessage() {
    var email = currentEmail;
    console.log(email);
}