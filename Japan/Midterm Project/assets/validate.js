function validateForm() {
    var name = document.forms["commentForm"]["name"].value;
    var email = document.forms["commentForm"]["email"].value;
    var comment = document.forms["commentForm"]["comment"].value;
    if (name === "" || email === "" || comment === "") {
        alert("Name, email, and comment must be filled out");
        return false;
    }
    return true;
}