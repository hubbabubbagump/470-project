function isEmpty(str) {
    return (!str || 0 === str.length);
}

function checkSubmit() {
    var form = document.forms["registrationForm"];
    if (isEmpty(form["name"].value) || isEmpty(form["email"].value) || isEmpty(form["password"].value)) {
        var errorDiv = document.getElementById("error");
        errorDiv.innerText = "Please fill in all boxes";

        return false;
    }
    return true;
}