function BuyFunc(event) {
    var btn = event.currentTarget;
    var qty = event.currentTarget.previousSibling.innerHTML;

    console.log(qty);
    console.log(btn);

    ++event.currentTarget.previousSibling.innerHTML;

    if (event.currentTarget.previousSibling.innerHTML > 0) {
        event.currentTarget.nextSibling.style.display = "inline";
    }
}

function ConsumeFunc(event) {

    var btn = event.currentTarget;
    var qty = event.currentTarget.previousSibling.previousSibling.innerHTML;
    console.log(btn);
    console.log(qty);

    if (qty < 1) {
        btn.style.display = "none";
    }
    else {
        --event.currentTarget.previousSibling.previousSibling.innerHTML;
    }

    var qty = event.currentTarget.previousSibling.previousSibling.innerHTML;
    if (qty < 1) {
        btn.style.display = "none";
    }

}