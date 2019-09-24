$(document).ready(function() {
    $("#clickAlert").click(function(){
        alert("Clicked!");
    });
    $("#changeColor").click(function(){
        var color = $("#colorInput").val();
        if (color == "") {
            alert("The text box needs something in it");
            return false;
        }
        $("#div1").css("background-color", color);
    });
    var visible = true;
    $("#toggleVis").click(function(){
        visible = !visible;
        if (visible) {
            $("#div3").fadeIn("slow");
        } else {
            $("#div3").fadeOut("slow");
        }
    });
});
