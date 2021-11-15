//dynamicallycheck with the server every 90 seconds to find outif there are any new groceries
setInterval(send_ajax_request, 90000);

window.onload = send_ajax_request;
window.onclick = send_ajax_request;

function send_ajax_request() {
    var uid = document.getElementById("uid").innerHTML;
    var fid = document.getElementById("fid").innerHTML;
    console.log("uid:",uid,"fid:",fid);
   
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.addEventListener("readystatechange", receive_ajax_response, false);

    xmlhttp.open("GET", "retreiveList.php?uid=" + uid + "&fid=" + fid, true);
    xmlhttp.send();
}

function receive_ajax_response() {
    if (this.readyState == 4 && this.status == 200) {
        var message_area = document.getElementById("msg");
        var section ;
        var body = document.getElementById("body");

        var results;
        try {
            results = JSON.parse(this.responseText);
        }

        catch {
            message_area.innerHTML = this.responseText;
            return;
        }


        if (results.length > 0) {

            var sc = document.getElementById("exists");
            if(sc){
                sc.remove();
            }
            sc = document.createElement("section");
            sc.setAttribute("id", "exists");
            body.appendChild(sc);

            var ouid= document.getElementById("uid").innerHTML;
            var ofid= document.getElementById("fid").innerHTML;

            var db_record;
            var div;
            var p;
            var br;
            var span;
            var btn;

            for (var i = 0; i < results.length; i++) {
                section = document.createElement("section");
                section.classList.add("ListItem");

                div = document.createElement("div");
                div.classList.add("item-block");


                //extract a record from the json results
                db_record = results[i];

                p = document.createElement("p");
                content = document.createTextNode(db_record.title);
                p.appendChild(content);
                br = document.createElement("br");
                p.appendChild(br);

                content = document.createTextNode(db_record.descript);
                p.appendChild(content);
                br = document.createElement("br");
                p.appendChild(br);
                br = document.createElement("br");
                p.appendChild(br);

                content = document.createTextNode("Date posted: ");
                p.appendChild(content);

                content = document.createTextNode(db_record.dt);
                p.appendChild(content);

                content = document.createTextNode(" by User ID: ");
                p.appendChild(content);

                content = document.createTextNode(db_record.u_id);
                p.appendChild(content);
                br = document.createElement("br");
                p.appendChild(br);


                content = document.createTextNode("Quantity:");
                p.appendChild(content);

                span = document.createElement("span");
                span.classList.add("qty-style");
                span.setAttribute("id", "qty1");
                content = document.createTextNode(db_record.qty);
                span.appendChild(content);
                p.appendChild(span);

                btn = document.createElement("button");
                btn.classList.add("buy1");
                btn.setAttribute("name", "buy");

                btn.setAttribute("onclick", "ajaxRqBuy("+ db_record.g_id+","+db_record.qty+")");

                content = document.createTextNode("Buy");
                btn.appendChild(content);
                p.appendChild(btn);

                if(db_record.qty >=1){
                btn = document.createElement("button");
                btn.classList.add("con");
                btn.setAttribute("name", "con");
                btn.setAttribute("onclick", "ajaxRqCon("+ db_record.g_id+","+db_record.qty+")");
                content = document.createTextNode("Consume");
                btn.appendChild(content);
                p.appendChild(btn);
                }

                content = document.createTextNode(db_record.u_id);

                if(parseInt(ouid) == parseInt(db_record.u_id)){
                btn = document.createElement("button");
                btn.classList.add("del");
                btn.setAttribute("name", "del");
                btn.setAttribute("onclick", "ajaxRqDel("+ db_record.g_id+","+db_record.qty+")");
                content = document.createTextNode("Delete");
                btn.appendChild(content);
                p.appendChild(btn);
                }

                div.appendChild(p);
                section.appendChild(div);
                sc.appendChild(section);
            }
            body.appendChild(sc);
        } 
        else {
            message_area.innerHTML = "No results found.";
        }
    }
    return;
} 


