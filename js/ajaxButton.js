function ajaxRqBuy(ev, qty) {
  var gid = ev;
  var qty = qty;
  console.log("gid:",gid,"qty:",qty);

  var x = new XMLHttpRequest();

  x.addEventListener("readystatechange", receive_ajax_response, false);

   x.open("GET", "buy.php?gid=" + gid+"&qty="+qty , true);
  x.send();
  console.log("buy rq sent");

}

function ajaxRqCon(ev, qty) {
  var gid = ev;
  var qty = qty;
  console.log("gid:",gid,"qty:",qty);

  var x = new XMLHttpRequest();

  x.addEventListener("readystatechange", receive_ajax_response, false);

   x.open("GET", "consume.php?gid=" + gid+"&qty="+qty , true);
   x.send();
   console.log("consume rq sent");
}

function ajaxRqDel(ev, qty) {
  var gid = ev;
  var qty = qty;
  console.log("gid:",gid,"qty:",qty);

  var x = new XMLHttpRequest();

  x.addEventListener("readystatechange", receive_ajax_response, false);

  x.open("GET", "delete.php?gid=" + gid+"&qty="+qty , true);
  x.send();
  console.log("delete rq sent");
}

function receive_ajax_response() {
  if (this.readyState == 4 && this.status == 200) {
        console.log("Success");
      }
  else{
    console.log("unsuccess");
  }
  return;
}