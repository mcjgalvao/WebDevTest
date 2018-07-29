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

	
    <script>
    var host = "127.0.0.1";//"localhost"; //"192.168.0.52"; 
    var vm;
    var g;
    var selectedPlant = 1;
    $(document).ready(function(){
    	new Vue({
  		  el: '#app',
  		  data: {
  		    message: 'Hello Vue.js by Marcelo!'
  		  }
  	  	});
        $(".graph-link").click(function() {
            console.log("ID: " + $(this).attr("id"));
            selectedKey = $(this).attr("id");
            $(".graph-link").removeClass("active");
            $(this).addClass("active");
            updateCanvas();
			//showMsg("Gr&aacute;fico atualizado");               
        });
            
		// Preenche myHostname com mesmo host recebido nesta requisição
		//console.log("URL: " + document.URL);
		var parser = document.createElement('a');
		parser.href = document.URL;
		//console.log("hostname: " + parser.hostname);
		var myHostname = parser.hostname;

		function updateCanvas() {
			var c = document.getElementById("myCanvas");
			var ctx = c.getContext("2d");
			var img = document.getElementById("myPlant");
			ctx.drawImage(img, 0, 0, c.width, c.height);

			if(selectedKey<0)
				return;
            // Use AJAX to get points
            var myObj = { "plantId": selectedPlant };
            var myJSON = JSON.stringify(myObj);
            var updateURL = "http://" + myHostname + ":8080/getThings";
			console.log("updateURL: " + updateURL);
			$.post(updateURL, myJSON, function(data,status) {
				console.log("status: " + status);
				if(status=="success") {
    				// parse JSON return
    				var retObj = JSON.parse(data);
    				//console.log("retObj: " + retObj);
    		        var graphData = [];
        			for(i=0;i<retObj.length;i++) {
            			var dataPoint = retObj[i];
        				//console.log("dataPoint[" + i + "] : " + dataPoint.t + "," + dataPoint.d);
        				graphData.push([new Date(dataPoint.t),dataPoint.d]);
        			}
    	            g.updateOptions(
    	    	       { 
    		    	    'file': graphData 
    //		    	    ,dateWindow: [Date.now() - 30 * 1000, Date.now() 
    			       }
    				);
				}
				else {
					showMsg("Error updating graph via POST");
				}
			}).fail(function(xhr, err) {
				showMsg("Exception thrown while updating graph via POST");
			});
		}			
		updateCanvas();
        window.intervalId = setInterval(updateCanvas, 10000);
    });
    function showMsg(msg) {
    	$("#rowMsg").html(
				"<div class=\"alert alert-warning alert-dismissible fade show\"> \
    				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>  \
    				<strong>Success!</strong> " + msg + " \
  				</div>");
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
	<img id="myPlant" src="plants/Apartamento.png" width=1200 height=800 style="display:none;"></img>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 jumbotron">
				<p>
				<h1>Home Automation Dashboard</h1>
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
                <ul class="list-group">
     <!--              <a href="#" class="list-group-item list-group-item-action">Third item</a> -->
				<?php 
                    $mysqli = new mysqli("localhost", "root", "manager", "iotdb");
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    }
                    
                    $res = $mysqli->query(
                        "SELECT T05_NAME AS n, T05_ID AS id, T04_FORM AS form, T04_SIZE AS size, T05_X AS x, T05_Y AS y, T05_STATE AS state FROM T05_THINGS, T04_THINGTYPES WHERE T05_T03_PLANT = 1 AND T05_T04_TYPE = T04_ID"
                        );
                    $res->data_seek(0);
                    while ($row = $res->fetch_assoc()) {
                        if($row['id']==1)
                            echo("<a id=\"".$row['id']."\" class=\"list-group-item list-group-item-action graph-link active\">".$row['n']."</a>");
                        else
                            echo("<a id=\"".$row['id']."\" class=\"list-group-item list-group-item-action graph-link\">".$row['n']."</a>");
                    }
                    
                    
                ?>
                </ul>
                <p></p>
        	</div>
			<div class="col-sm-9" style="border-style:solid;border-width:1;padding:10px;">
    		    <canvas id="myCanvas" width="600" height="400" style="width:100%;height:100%;"></canvas>
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


