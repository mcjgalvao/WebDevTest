var http = require('http');
var url = require('url');
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  database: "iotdb",
  password: "manager"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});

function saveData(obj, callback) {
  // Recupera ID da variavel a partir do Key
  var sql1 = "SELECT T01_ID AS id FROM T01_VARIABLES WHERE T01_KEY = " + obj.key;
  //console.log('sql1: ' + sql1);
  con.query(sql1, function (err, result, fields) {
    if (err) throw err;
    if(result.length==1) {
    	obj.variableId = result[0].id;
    	//console.log("ID "+ obj.variableId + " retreived from KEY " + result[0].id);

	    var sql2 = "INSERT INTO T02_DATA (T02_T01_VARIABLE, T02_DATA) VALUES(" + obj.variableId + ", " + obj.value + ")";
		//console.log('sql2: ' + sql2);
		con.query(sql2, function (err, result) {
		  if (err) throw err;
		  console.log("Success: 1 record inserted");
		  callback();
		});

    }	
    else if(result.length==0)
    	console.log("KEY " + obj.key + " not found");
    else
    	console.log("Multiple Keys found " + result.length);
  });
	
}

function getData(obj, callback) {
	  // Recupera ID da variavel a partir do Key
	  var sql1 = "SELECT T01_ID AS id FROM T01_VARIABLES WHERE T01_KEY = " + obj.key;
	  //console.log('sql1: ' + sql1);
	  con.query(sql1, function (err, result, fields) {
	    if (err) throw err;
	    if(result.length==1) {
	    	obj.variableId = result[0].id;
	    	//console.log("ID "+ obj.variableId + " retreived from KEY " + result[0].id);

		    var sql2 = "SELECT DATE_FORMAT(T02_TIMESTAMP,'%Y-%m-%d %H:%i:%S') AS t, T02_DATA AS d FROM T02_DATA WHERE T02_T01_VARIABLE = " + obj.variableId + " ORDER BY T02_TIMESTAMP";
			//console.log('sql2: ' + sql2);
			con.query(sql2, function (err, result) {
			  if (err) throw err;
			  console.log("Success: " + result.length + " record(s) selected");
			  var ret = [];
			  for(i=0;i<result.length;i++) {
				  ret.push({t: result[i].t,d: result[i].d});
			  }
			  callback(ret);
			});

	    }	
	    else if(result.length==0)
	    	console.log("KEY " + obj.key + " not found");
	    else
	    	console.log("Multiple Keys found " + result.length);
	  });
		
	}


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
 
  if(req.url=="/getData") {
  	  var qdata = '';
	  if(req.method == 'POST') {
	 	  req.on('data', function(data) {
	 		 qdata+=data; 
	 	  });
		  req.on('end', function() {
			  console.log('qdata: ' + qdata);
			  var obj = JSON.parse(qdata);
			  
			  getData(obj, function(ret) {
				  res.end(JSON.stringify(ret));
			  });
		  });
	  }
	  else {
		  var urlParse = url.parse(req.url, true);
		  //var txt = q.year + " " + q.month;
		  qdata = decodeURI(urlParse.search.replace("?",""));
		  var obj = JSON.parse(qdata);
		  
		  getData(obj, function(ret) {
			  res.end(JSON.stringify(ret));
		  });
	
	  }
  }
  else {
  	  var qdata = '';
	  if(req.method == 'POST') {
	 	  req.on('data', function(data) {
	 		 qdata+=data; 
	 	  });
		  req.on('end', function() {
			  console.log('qdata: ' + qdata);
			  var obj = JSON.parse(qdata);
			  
			  saveData(obj, function() {
				  obj.age=1;
				  res.end(JSON.stringify(obj));
			  });
		  });
	  }
	  else {
		  var urlParse = url.parse(req.url, true);
		  //var txt = q.year + " " + q.month;
		  qdata = decodeURI(urlParse.search.replace("?",""));
		  var obj = JSON.parse(qdata);
		  
		  saveData(obj, function() {
			  obj.age=2;
			  res.end(JSON.stringify(obj));
		  });
	
	  }
  }

}).listen(8080);