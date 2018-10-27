'use strict';

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function isEmptyPassword(str) {
    return (str && !str.replace(/\s/g, '').length);
}

var request;

function checkSubmit() {
    var form = document.forms["registrationForm"];
    var errorDiv = document.getElementById("error");
    if ((isEmpty(form["name"].value) || isEmpty(form["password"].value || isEmpty(form["email"].value)))) {
        errorDiv.innerText = "* Please fill in all boxes";
        return false;
    }
    else if (isEmptyPassword(form["password"].value)) {
        errorDiv.innerText = "* Invalid password";
        return false;
    }

    errorDiv.innerText = "";

    if (request) {
        request.abort();
    }

    request = $.ajax({
        url: "/index.php/register/create",
        type: "post",
        data: {email: form['email'].value, password: form['password'].value, name: form['name'].value}
    });

    request.done(function (response, textStatus, jqXHR) {
        window.location.href = "/";
    })

    request.fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus, errorThrown);
        if (errorThrown == "Invalid parameters") {
            errorDiv.innerText = "* Please fill in all boxes";
        }
        else {
            errorDiv.innerText = "* Email already in use"
        }
    });

    return false;
}