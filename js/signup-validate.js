function SignUpForm(event) {
    var valid = true;

    var elements = event.currentTarget;
    var uname = elements[0].value;
    var email = elements[1].value;
    var dob = elements[2].value;
    var img = elements[3].value;
    var pswd = elements[4].value;
    var pswdr = elements[5].value;


    var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var regex_uname = /^[a-zA-Z0-9_-]+$/;
    var regex_pswd = /\w+[^a-zA-Z+]\w*/;
    var regex_dob = /^[1-2][9|0][0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/;

    var msg_uname = document.getElementById("msg_uname");
    var msg_email = document.getElementById("msg_email");
    var msg_dob = document.getElementById("msg_dob");
    var msg_img = document.getElementById("msg_img");
    var msg_pswd = document.getElementById("msg_pswd");
    var msg_pswdr = document.getElementById("msg_pswdr");
    msg_uname.innerHTML = "";
    msg_email.innerHTML = "";
    msg_dob.innerHTML = "";
    msg_img.innerHTML = "";
    msg_pswd.innerHTML = "";
    msg_pswdr.innerHTML = "";

    var textNode;
    var htmlNode;

    if (uname == null || uname == "") {
        textNode = document.createTextNode("Username is empty.");
        msg_uname.appendChild(textNode);
        valid = false;
    } else if (regex_uname.test(uname) == false) {
        textNode = document.createTextNode("Username is invalid. Be sure it does not contain strange symbols or have extra spaces everywhere.");
        msg_uname.appendChild(textNode);
    } else if (uname.length > 40) {
        textNode = document.createTextNode("Username address too long. Maximum is 40 characters.");
        msg_uname.appendChild(textNode);
        valid = false;
    }

    if (email == null || email == "") {
        textNode = document.createTextNode("Email address empty.");
        msg_email.appendChild(textNode);
        valid = false;
    } else if (regex_email.test(email) == false) {
        textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
    } else if (email.length > 60) {
        textNode = document.createTextNode("Email address too long. Maximum is 60 characters.");
        msg_email.appendChild(textNode);
        valid = false;
    }
    
    if (dob == null || dob == "") {
        textNode = document.createTextNode("D.O.B. is empty.");
        msg_dob.appendChild(textNode);
        valid = false;
    } else if (regex_dob.test(dob) == false) {
        textNode = document.createTextNode("D.O.B wrong format. example: YYYY-MM-DD");
        msg_dob.appendChild(textNode);
        valid = false;
    }

    if(img ==null || img == ""){
        textNode = document.createTextNode("No image file selected");
        msg_img.appendChild(textNode);
        valid=false;
    }

    if (pswd == null || pswd == "") {
        textNode = document.createTextNode("Password is empty.");
        msg_pswd.appendChild(textNode);
        valid = false;
    } else if (regex_pswd.test(pswd) == false) {
        textNode = document.createTextNode("Password is invalid. It must contain letters and at least one non-letter character.");
        msg_pswd.appendChild(textNode);
    } else if (pswd.length != 6) {
        textNode = document.createTextNode("Password must be 6 characters.");
        msg_pswd.appendChild(textNode);
        valid = false;
    }

    if (pswdr == null || pswdr == "") {
        textNode = document.createTextNode("Confirm Password is empty.");
        msg_pswdr.appendChild(textNode);
        valid = false;
    } else if (pswd != pswdr) {
        textNode = document.createTextNode("Confirm Password and Password does not match.");
        msg_pswdr.appendChild(textNode);
        valid = false;
    }

    console.log(uname);
    console.log(email);
    console.log(dob);
    console.log(img);
    console.log(pswd);
    console.log(pswdr);

    if (valid == true) {
        //document.getElementById("SignUp").reset();
    } else {
        event.preventDefault();
    }

}

function ResetSignForm(event) {
    for (let i = 0; i < 6; i++) {
        event.currentTarget[i] = "";
    }

    msg_uname.innerHTML = "";
    msg_email.innerHTML = "";
    msg_dob.innerHTML = "";
    msg_img.innerHTML = "";
    msg_pswd.innerHTML = "";
    msg_pswdr.innerHTML = "";
}