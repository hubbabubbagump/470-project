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
                    renderItem(item, container, bColor);
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

        var container = document.getElementById("itemList");

        if (results === undefined || results.length == 0) {
            document.getElementById("getMore").style.display = "none";
        }
        else {
            for (var i in results) {
                if (results.hasOwnProperty(i)) {
                    let item = results[i];
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    renderItem(item, container, bColor);
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
                    renderItem(item, container, bColor);
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

function renderItem(item, container, bColor) {
    var div = document.createElement("div");
    div.style.backgroundColor = bColor;
    div.className = "itemBox";
    div.id = item._id;

    var msgBox = document.createElement("div");
    msgBox.className = "msgBox";
    msgBox.innerText = "Message";

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

    div.appendChild(msgBox);
    div.appendChild(title);
    div.appendChild(course);
    div.appendChild(price);
    container.appendChild(div);

    title.addEventListener("click", function() {
        openModal(item._id);
    });

    msgBox.addEventListener("click", function() {
        openMessageModal(item.sellerEmail);
    });
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

            document.getElementById("modal").style.display = "block";
        }
        else {
            alert("Invalid item id");
        }
    });

    itemRequest.fail(function(jqXHR, textStatus, errorThrown) {
    });
}

var currentEmail;

function openMessageModal(email) {
    currentEmail = email;
    var msgModal = document.getElementById("msgModal");
    msgModal.style.display = "block";
}

function sendMessage() {
    var email = currentEmail;
    console.log(email);
}