var http = require('http');
var url = require('url');

http.createServer(function (req, res) {
  console.log('CALLED: ' + decodeURI(req.url));
  if(req.url=="/favicon.ico")
	  return;
  res.writeHead(200, {'Content-Type': 'text/html','Access-Control-Allow-Origin' : '*'});
  var urlParse = url.parse(req.url, true);
  //var txt = q.year + " " + q.month;
  var qdata = decodeURI(urlParse.search.replace("?",""));
  var obj = JSON.parse(qdata);
  obj.age++;
  res.end(JSON.stringify(obj));
}).listen(8080);