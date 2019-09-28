var canvas = document.getElementById("VotingCanvas");
var ctx = canvas.getContext("2d");
var radius = 50;
ctx.fillStyle = "#000000";
ctx.fillRect(0,0,500,500);
ctx.beginPath();
ctx.arc(250, 50, radius, 0, 2* Math.PI, false);
ctx.fillStyle = "#FF0000";
context.fill();
