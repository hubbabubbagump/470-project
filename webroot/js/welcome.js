var searchBox = document.getElementById("searchBox");
searchBox.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        getItems();
    }
});

var searchRequest;

function getItems() {
    var searchBox = document.getElementById("searchBox");
    var text = searchBox.value;
    if (!text || text == "") {
        return;
    }

    if (searchRequest) {
        searchRequest.abort();
    }

    var searchText = document.getElementById("searchText");
    searchText.style.display = "none";
    $(".loaderDiv").addClass("loading");

    searchRequest = $.ajax({
        url: "/index.php/search/search",
        type: "get",
        data: {query: text}
    });

    searchRequest.done(function (response, textStatus, jqXHR) {
        var results = JSON.parse(response);

        var container = document.getElementById("itemContainer");
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }

        console.log(results);

        if (results === undefined || results.length == 0) {
            var noItems = document.createElement("p");
            noItems.innerText = "No items found";
            container.appendChild(noItems);
        }
        else {
            for (var i in results) {
                if (results.hasOwnProperty(i)) {
                    var item = results[i];
                    // console.log(item.title);
                    var div = document.createElement("div");

                    var title = document.createElement("p");
                    title.innerText = item.title;

                    var course = document.createElement("p");
                    course.innerText = item.faculty + " " + item.courseNum;

                    var description = document.createElement("p");
                    description.innerText = item.desc;

                    div.appendChild(title);
                    div.appendChild(course);
                    div.appendChild(description);
                    container.appendChild(div);
                }
            }
        }
    });

    searchRequest.fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
    });

    searchRequest.always(function(jqXHR, textStatus){
        searchText.style.display = "block";
        $(".loaderDiv").removeClass("loading");
    });
}