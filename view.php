<!DOCTYPE html>
<!-- HTML5 -->
<html lang="en">
<head>
	<title>IOT Viewer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.css">	
    <script src="./script/jquery-3.3.1.js"></script>
	<script src="./script/vue.js"></script>
	<script src="./script/bootstrap.js"></script>
	<script src="./script/dygraph.js"></script>
	<link rel="stylesheet" href="./css/dygraph.css" />
	
    <script>
    var host = "127.0.0.1";//"localhost"; //"192.168.0.52"; 
    var vm;
    var g;
    $(document).ready(function(){
    	new Vue({
  		  el: '#app',
  		  data: {
  		    message: 'Hello Vue.js by Marcelo!'
  		  }
  	  	});
        $("#clickButton").click(function() {
			$("#teste").html("<p>Hello JavaScript!</p>");
			showMsg("Gr&aacute;fico atualizado");               
        });
        g = new Dygraph(
                
                // containing div
                document.getElementById("graphdiv"),
            
                // CSV or path to a CSV file.
                "Timestamp,Light\n" +
                <?php 
                    $mysqli = new mysqli("localhost", "root", "manager", "iotdb");
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    }
                
                    $res = $mysqli->query(
                        "SELECT T02_TIMESTAMP AS t, T02_DATA AS v FROM T02_DATA, T01_VARIABLES ".
                        " WHERE T01_KEY = 1 AND T02_T01_VARIABLE = T01_ID"
                        );
                    $res->data_seek(0);
                    while ($row = $res->fetch_assoc()) {
                        echo("\"".$row['t'].",".$row['v']."\\n\" + \n");
                    }
                    echo("\"\\n\"\n");
                    ?>
				, { drawPoints:true, pointSize:3 }
        );
        window.intervalId = setInterval(function() {
            // Use AJAX to get points
            var myObj = { "key":"1" };
            var myJSON = JSON.stringify(myObj);
			$.post("http://" + host + ":8080/getData", myJSON, function(data,status) {
				//console.log("data: " + data);
				// parse JSON return
				var retObj = JSON.parse(data);
				//console.log("retObj: " + retObj);
		        var graphData = [];
    			for(i=0;i<retObj.length;i++) {
        			var dataPoint = retObj[i];
    				//console.log("dataPoint[" + i + "] : " + dataPoint.t + "," + dataPoint.d);
    				graphData.push([new Date(dataPoint.t),dataPoint.d]);
    			}
	            g.updateOptions( { 'file': graphData } );
			});
            
        }, 10000);
    });
    function showMsg(msg) {
    	$("#rowMsg").html(
				"<div class=\"alert alert-success alert-dismissible fade show\"> \
    				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>  \
    				<strong>Success!</strong> " + msg + " \
  				</div>");
    };
    function showRet(data) {
		var myObj = JSON.parse(data);
		$("#ret").html("<p><span class='badge badge-primary'>Nome</span> " + myObj.name 
				+ "<p><span class='badge badge-primary'>Idade</span> " + myObj.age 
				+ "<p><span class='badge badge-primary'>Cidade</span> " + myObj.city);
    };
    </script>
	<style>
	.vue-js {
	   color: red;
	}
	.php {
	   color: blue;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 jumbotron">
				<p>
				<h1>IOT Sensor Data Visualization</h1>
        		<div id="app" class="vue-js">
            		<p>{{ message }}</p>
        		</div>
        		<p>
			</div>
		</div>
		<div class="row">
			<div id="rowMsg" class="col-sm-12">
			</div>
		</div>		  
		<div class="row">
			<div class="col-sm-2">
        		<button id="clickButton" type="button" class="btn btn-primary btn-lg btn-block">Update</button>
		        <div id="teste">
        		</div>
        		<p></p>
        	</div>
			<div class="col-sm-9" style="border-style:solid;border-width:1;padding:25px;">
				<p></p>
				<p></p>
    		    <div id="graphdiv" style="width:100%; "></div>
			</div>
			<div class="col-sm-1">
			</div>
       	</div>
        <?php     
            //phpinfo();
    	?>
    	<script>
    		console.log(5 + 6);
    		console.log("Testando...");
    	</script>
	</div>
</body>
</html>


