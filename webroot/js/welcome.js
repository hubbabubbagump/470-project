var searchBox = document.getElementById("searchBox");
searchBox.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        getItems();
    }
});

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
                    var item = results[i];
                    // console.log(item.title);
                    var div = document.createElement("div");
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    div.style.backgroundColor = bColor;
                    div.className = "itemBox";
                    div.id = item._id;

                    var title = document.createElement("p");
                    title.innerText = item.title;
                    title.className = "title";

                    var course = document.createElement("p");
                    course.innerText = item.faculty + " " + item.courseNum;
                    course.className = "course";

                    var price = document.createElement("p");
                    price.innerText = "$" + item.price.toFixed(2);
                    price.className = "price";

                    var description = document.createElement("p");
                    description.innerText = item.desc;
                    description.className = "desc";

                    div.appendChild(title);
                    div.appendChild(course);
                    div.appendChild(price);
                    // div.appendChild(description);
                    container.appendChild(div);
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
                    var item = results[i];
                    // console.log(item.title);
                    var div = document.createElement("div");
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    div.style.backgroundColor = bColor;
                    div.className = "itemBox";
                    div.id = item._id;

                    var title = document.createElement("p");
                    title.innerText = item.title;
                    title.className = "title";

                    var course = document.createElement("p");
                    course.innerText = item.faculty + " " + item.courseNum;
                    course.className = "course";

                    var price = document.createElement("p");
                    price.innerText = "$" + item.price.toFixed(2);
                    price.className = "price";

                    var description = document.createElement("p");
                    description.innerText = item.desc;
                    description.className = "desc";

                    div.appendChild(title);
                    div.appendChild(course);
                    div.appendChild(price);
                    container.appendChild(div);
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
                    var item = results[i];
                    // console.log(item.title);
                    var div = document.createElement("div");
                    var bColor = (((i % 2) == 0) ? "#FFF" : "#F5F5F5");
                    div.style.backgroundColor = bColor;
                    div.className = "itemBox";
                    div.id = item._id;

                    var title = document.createElement("p");
                    title.innerText = item.title;
                    title.className = "title";

                    var course = document.createElement("p");
                    course.innerText = item.faculty + " " + item.courseNum;
                    course.className = "course";

                    var price = document.createElement("p");
                    price.innerText = "$" + item.price.toFixed(2);
                    price.className = "price";

                    var description = document.createElement("p");
                    description.innerText = item.desc;
                    description.className = "desc";

                    div.appendChild(title);
                    div.appendChild(course);
                    div.appendChild(price);
                    container.appendChild(div);
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