var canvas = document.getElementById("VotingCanvas");
var ctx = canvas.getContext("2d");
var connections = [[0,0,0,0,0],
                   [0,0,0,0,0],
                   [0,0,0,0,0],
                   [0,0,0,0,0],
                   [0,0,0,0,0]];
//Columns go A-E, Rows go A-E
// [,ab, ac, bc, ad, bd, cd, , ea, eb, ce, , de]
var strength = [0,0,0,0,0,0,0,0,0,0,0,0,0];
var direction = [0,0,0,0,0,0,0,0,0,0,0,0,0];

var A = [250, 60];
var B = [69, 191];
var C = [138, 404];
var D = [362, 404];
var E = [431, 191];

function drawCircle(x, y) {
    ctx.beginPath();
    ctx.arc(x, y, 50, 0, 2* Math.PI);
    ctx.stokeStyle = "#FFFFFF";
    ctx.stroke();
    ctx.fillStyle = "#FF0000";
    ctx.fill();
}
function getPointValue(x) {
    if (x == A[0])
        return 0;
    if (x == B[0])
        return 1;
    if (x == C[0])
        return 2;
    if (x == D[0])
        return 4;
    if (x == E[0])
        return 8;
}
function getNumValue(x) {
    if (x == 3)
        return 4;
    if (x == 4)
        return 8;
    return x;
}
function getStrengthIndex(x1, x2) {
    var a = getPointValue(x1);
    var b = getPointValue(x2);
    return strength[a+b];
}
function getDirectionIndex(x1, x2) {
    var a = getPointValue(x1);
    var b = getPointValue(x2);
    return direction[a+b];
}
function drawStrength(x1, y1, x2, y2) {
    ctx.beginPath();
    var x = x1+(x2-x1)*0.5;
    var y = y1+(y2-y1)*0.5;
    ctx.arc(x, y, 30, 0, 2* Math.PI);
    ctx.fillStyle = "#FFFFFF";
    ctx.strokeStyle = "#000000";
    ctx.stroke();
    ctx.fill();
    ctx.font = "30px Arial";
    ctx.fillStyle = "#000000";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    var displayStrength = getStrengthIndex(x1, x2);
    ctx.fillText(displayStrength, x, y);
}
//because the lines are drawn from the center of each circle, this little function
//right here creates a point that falls short of the end of the line by n units.
//This is used to place the arrow, or in this case, a circle, right on the outer
//edge of the point the graph is pointing to
function shortPoint(a, b, n) {
    var nD = n/Math.sqrt(Math.pow(b[0] - a[0], 2) + Math.pow(b[1] - a[1], 2));
    var x = (1-nD)*a[0]+nD*b[0];
    var y = (1-nD)*a[1]+nD*b[1];
    return [x,y];
}
function drawDirection(x1, y1, x2, y2) {
    var point = [0,0];
    var n = 50;
    var dir = getDirectionIndex(x1, x2);
    if (dir == 0) {
        return;
    }
    if (dir < 0) {
        point = shortPoint([x1, y1], [x2, y2], n);
    }
    if (dir > 0) {
        point = shortPoint([x2, y2], [x1, y1], n);
    }
    ctx.beginPath();
    ctx.arc(point[0], point[1], 10, 0, 2 * Math.PI);
    ctx.fillStyle = "#000000";
    ctx.fill();
}
function drawLine(x1, y1, x2, y2) {
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.stroke();
    drawDirection(x1, y1, x2, y2);
    drawStrength(x1, y1, x2, y2);
}
function drawPentagon() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawLine(A[0], A[1], B[0], B[1]);
    drawLine(A[0], A[1], C[0], C[1]);
    drawLine(B[0], B[1], C[0], C[1]);
    drawLine(A[0], A[1], D[0], D[1]);
    drawLine(B[0], B[1], D[0], D[1]);
    drawLine(C[0], C[1], D[0], D[1]);
    drawLine(A[0], A[1], E[0], E[1]);
    drawLine(B[0], B[1], E[0], E[1]);
    drawLine(C[0], C[1], E[0], E[1]);
    drawLine(D[0], D[1], E[0], E[1]);
    drawCircle(A[0], A[1]);
    drawCircle(B[0], B[1]);
    drawCircle(C[0], C[1]);
    drawCircle(D[0], D[1]);
    drawCircle(E[0], E[1]);
    ctx.font = "50px Arial";
    ctx.fillStyle = "#000000";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle"
    ctx.fillText("A", A[0], A[1]);
    ctx.fillText("B", B[0], B[1]);
    ctx.fillText("C", C[0], C[1]);
    ctx.fillText("D", D[0], D[1]);
    ctx.fillText("E", E[0], E[1]);
}

drawPentagon();

function SortByValue(a, b){
    var aVal = a["value"];
    var bVal = b["value"];
    return ((aVal < bVal) ? -1 : ((aVal > bVal) ? 1 : 0));
}

function NameToNumber(value) {
    switch(value["name"]) {
        case "A":
            return 0;
        case "B":
            return 1;
        case "C":
            return 2;
        case "D":
            return 3;
        case "E":
            return 4;
    }
    return -1;
}
function NumberToName(num) {
    switch(num) {
        case 0:
            return "A";
        case 1:
            return "B";
        case 2:
            return "C";
        case 3:
            return "D";
        case 4:
            return "E";
    }
    return "X";
}

function UpdateConnections(values) {
    for (var i = 0; i < values.length; i++) {
        for (var j = i+1; j < values.length; j++) {
            connections[NameToNumber(values[i])][NameToNumber(values[j])]++;
        }
    }
}

function FormRank() {
    var rank = [[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]];
    for (var i = 0; i < rank.length; i++) {
        for (var j = 0; j < rank.length; j++) {
            if (i != j) {
                if (connections[i][j] > connections[j][i]) {
                    rank[i][j] = connections[i][j];
                } else {
                    rank[i][j] = 0;
                }
            }
        }
    }
    for (var i = 0; i < rank.length; i++) {
        for (var j = 0; j < rank.length; j++) {
            if (i != j) {
                for ( var k = 0; k < rank.length; k++) {
                    if (i != k && j != k) {
                        rank[j][k] = Math.max(rank[j][k], Math.min(rank[j][i],rank[i][k]));
                    }
                }
            }
        }
    }
    var rankList = [4,3,2,1,0];
    for (var i = 0; i < rank.length; i++) {
        for (var j = 0; j < rank.length; j++) {
            if (i != j) {
                var iIndex = rankList.indexOf(i);
                var jIndex = rankList.indexOf(j);
                if (rank[i][j] > rank[j][i]) {
                    strength[getNumValue(i)+getNumValue(j)] = rank[i][j];
                    direction[getNumValue(i)+getNumValue(j)] = 1;
                    if (iIndex > jIndex) {
                        var temp = rankList.splice(iIndex,1)[0];
                        rankList.splice(jIndex,0,temp);
                    }
                } else {
                    strength[getNumValue(j)+getNumValue(i)] = rank[j][i];
                    direction[getNumValue(i)+getNumValue(j)] = -1;
                    if (jIndex > iIndex) {
                        var temp = rankList.splice(jIndex,1)[0];
                        rankList.splice(iIndex,0,temp);
                    }
                }
            }
        }
    }
    $("#rank").html(NumberToName(rankList[0]));
    for (var i = 1; i < rankList.length; i++) {
        $("#rank").html($("#rank").html() + "<br>" + NumberToName(rankList[i]));
    }
    drawPentagon();
}

$("#castVote").click(function() {
    var formValues = $("form#voteForm input[type=number]").serializeArray();
    formValues.sort(SortByValue);
    if ($("#pastVotes").html() != "") {
        $("#pastVotes").html($("#pastVotes").html() + "<br>");
    }
    for (var i = 0; i < formValues.length; i++) {
        $("#pastVotes").html($("#pastVotes").html() + formValues[i]["name"]);
    }
    UpdateConnections(formValues);
    FormRank();
});

function shuffle(array) {
    var currentIndex = array.length, temp, randIndex;

    while(0 !== currentIndex) {
        randIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temp = array[currentIndex];
        array[currentIndex] = array[randIndex];
        array[randIndex] = temp;
    }

    return array;
}

$("#randomVote").click(function() {
    var formValues = $("form#voteForm input[type=number");
    var ranks = [1,2,3,4,5];
    ranks = shuffle(ranks);
    for (var i = 0; i < formValues.length; i++) {
        formValues.eq(i).val(ranks[i]);
    }
});
