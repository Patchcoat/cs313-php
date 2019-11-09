const http = require('http');
const url = require('url');

function writeHtml(res, title) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write("<!DOCTYPE>"+
        "<html><head>"+
        "<title>"+title+"</title>"+
        "</head>"+
        "<body>");
}
function writeHtmlEnd(res) {
    res.write("</body>");
    res.write("</html>");
}

function writeHome(req, res) {
    writeHtml(res, "CS313");
    res.write("<h1>Welcome to the Home Page</h1>");
    writeHtmlEnd(res);
}

function writeData(req, res) {
    res.writeHead(200, {'Content-Type': 'application/json'});
    let jsonObj = {
        "name":"Br. Porter",
        "class":"cs313"
    };
    var jsonString = JSON.stringify(jsonObj);
    res.write(jsonString);
}

function write404(req, res) {
    writeHtml(res, "CS313");
    res.write("<h1>Page Not Found</h1>");
    writeHtmlEnd(res);
}

function writeDieRoll(req, res, urlParse) {
    var count = Math.floor(urlParse.query['count']);
    var die = Math.floor(urlParse.query['die']);
    if (count == undefined || isNaN(count)) {
        count = 1;
    }
    if (die == undefined || isNaN(die)) {
        die = 6;
    }
    writeHtml(res, "CS313");
    res.write("<h1>Rolling "+count+"d"+die+"</h1>");
    var result = 0;
    for (var i = 0; i < count; i++) {
        result += Math.floor((Math.random() * die) + 1)
    }
    if (die != 0) {
        res.write("<p>Result: "+result+"</p>");
    } else {
        res.write("<p>Result: "+0+"</p>");
        res.write("<p>What does a zero sided die even mean?</p>");
    }
    writeHtmlEnd(res);
}

function onRequest(req, res) {
    if (req.method == 'GET') {
        var urlParse = url.parse(req.url, true);
        switch(urlParse.pathname) {
            case "/home":
                writeHome(req, res);
                break;
            case "/getData":
                writeData(req, res);
                break;
            case "/roll":
                writeDieRoll(req, res, urlParse);
                break;
            default:
                write404(req, res);
                break;
        }
    }
    res.end();
}

var server = http.createServer(onRequest);
server.listen(8888);
