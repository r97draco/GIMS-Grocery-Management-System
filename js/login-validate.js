function LogInForm(event) {
    var valid = true;
    var elements = event.currentTarget;
    var email = elements[1].value;
    var pswd = elements[2].value;

    var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var regex_pswd = /^\S{6,}$/;

    var msg_email = document.getElementById("msg_email");
    var msg_pswd = document.getElementById("msg_pswd");
    msg_email.innerHTML = "";
    msg_pswd.innerHTML = "";

    var textNode;
    var htmlNode;

    if (email == null || email == "") {
        textNode = document.createTextNode("Email address is empty.");
        msg_email.appendChild(textNode);
        valid = false;
    } else if (regex_email.test(email) == false) {
        textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
    }

    if (pswd == null || pswd == "") {
        textNode = document.createTextNode("Password is empty.");
        msg_pswd.appendChild(textNode);
        valid = false;
    } else if (regex_pswd.test(pswd) == false) {
        textNode = document.createTextNode("Length should be > 6 & No whitespaces");
        msg_pswd.appendChild(textNode);
        valid = false;
    }

    console.log(email);
    console.log(pswd);

    if (valid == true) {
        //document.getElementById("fLogin").reset();
    } else {
        event.preventDefault();
    }

}

function ResetLogForm(event) {
    for (let i = 1; i < 3; i++) {
        event.currentTarget[i] = "";
    }

    msg_email.innerHTML = "";
    msg_pswd.innerHTML = "";
}

