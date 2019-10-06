var cart = [];
$(document).ready(function() {
    cart = JSON.parse(Cookies.get('cart'));
    if (cart.length == 0) {
        $("#cart").text("");
    } else {
        $("#cart").text(cart.length);
    }
});

function addToCart(item) {
    cart.push(item);
    var cartString = JSON.stringify(cart);
    document.cookie = "cart="+cartString;
    if (cart.length == 0) {
        $("#cart").text("");
    } else {
        $("#cart").text(cart.length);
    }
}

function removeItemFromCart(item) {
    cart.splice(item, 1);
    document.cookie = "cart=" + JSON.stringify(cart);
    location.reload();
}

function clearCart() {
    cart = [];
    document.cookie = "cart=" + JSON.stringify(cart);
    location.reload();
}
