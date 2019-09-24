function clickedAlert() {
    alert("Clicked!");
}

function changeColor() {
    var color = document.forms["colorChange"]["color"].value;
    if (color == "") {
        alert("The text box needs something in it");
        return false;
    }
    var div1 = document.getElementById('div1');
    div1.style.backgroundColor = color;
}
