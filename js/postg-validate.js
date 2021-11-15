function PostForm(event){
    var valid = true;

    var elements= event.currentTarget;
    var title = document.getElementById("title").value;
    var desc = document.getElementById("desc").value
    var qty = document.getElementById("qty").value;

    var msg_title = document.getElementById("msg_title");
    var msg_desc = document.getElementById("msg_desc");
    var msg_qty = document.getElementById("msg_qty");
    msg_title.innerHTML="";
    msg_desc.innerHTML="";
    msg_qty.innerHTML="";

    var textNode;
    var htmlNode;

    if(title == null || title == ""){
        textNode = document.createTextNode("Title can not be Empty.");
        msg_title.appendChild(textNode);
        valid=false;
    }

    if(desc == null || desc == ""){
        textNode = document.createTextNode("Description can not be Empty.");
        msg_desc.appendChild(textNode);
        valid=false;
    }

    if(qty == null || title == "" || qty < 1){
        textNode = document.createTextNode("Quantity can not be Empty or less than 1.");
        msg_qty.appendChild(textNode);
        valid=false;
    }

    console.log(title);
    console.log(desc);
    console.log(qty);

    if (valid == true) {
  
    } else {
        event.preventDefault();
    }
}