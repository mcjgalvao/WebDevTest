var http = require('http');
var url = require('url');

function wait(ms){
	   var start = new Date().getTime();
	   var end = start;
	   while(end < start + ms) {
	     end = new Date().getTime();
	  }
	};

http.createServer(function (req, res) {
  console.log('CALLED: ' + decodeURI(req.url));
  if(req.url=="/favicon.ico")
	  return;
  res.writeHead(200, {
	  'Content-Type': 'text/html',
	  'Access-Control-Allow-Origin' : '*',
	  'Cache-Control' : 'no-cache, no-store, must-revalidate',
	  'Pragma' : 'no-cache',
	  'Expires' : '0'
  });
 
  var qdata = '';
  var done = false;
  if(req.method == 'POST') {
 	  req.on('data', function(data) {
//    	 console.log('data: ' + data);
 		 qdata+=data; 
 	  });
	  req.on('end', function() {
//	   	  console.log('end');
		  console.log('qdata: ' + qdata);
		  var obj = JSON.parse(qdata);
		  var timestamp = new Date();
		  console.log('obj.value: ' + obj.value);
		  console.log('obj.timestamp: ' + timestamp);
		  // Grava no banco de dados
		  var ret = {ret:0, id:"101"};
		  //
		  res.end(JSON.stringify(ret));
	  });
  }
  else {
	  var urlParse = url.parse(req.url, true);
	  //var txt = q.year + " " + q.month;
	  qdata = decodeURI(urlParse.search.replace("?",""));
	  var obj = JSON.parse(qdata);
	  obj.age++;
	  res.end(JSON.stringify(obj));
  }
}).listen(8080);