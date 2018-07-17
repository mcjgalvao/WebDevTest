<!DOCTYPE html>
<!-- HTML5 -->
<html lang="en">
<head>
	<title>My Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.css">	
    <script src="./script/jquery-3.3.1.js"></script>
	<script src="./script/vue.js"></script>
	<script src="./script/bootstrap.js"></script>
    <script>
    var host = "192.168.0.52";//"127.0.0.1";//"localhost"; //"192.168.0.52"; 
    var vm;
    $(document).ready(function(){
    	new Vue({
  		  el: '#app',
  		  data: {
  		    message: 'Hello Vue.js by Marcelo!'
  		  }
  	  	});
  		new Vue({
  		  el: '#app1',
  		  data: {
  		    msg: 'Vue.js'
  		  }
  		});
    	vm = new Vue({
    		  el: '#app2',
    		  data: {
    		    msg1: 'Mensagem 1',
    	  		msg2: 'Mensagem 2',
    	  		msg3: 'badge badge-warning'   
    		  }
  		});
        $("p").click(function(){
            $(this).hide();
        });
        $("#btn-ajax-get-php").click(function(){
            var myObj = { "name":"John", "age":32, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.get("demo_json.php?" + myJSON, function(data,status) {
				showRet(data);
			});
        });
        $("#btn-ajax-post-php").click(function(){
            var myObj = { "name":"John", "age":33, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.post("demo_json.php", myJSON, function(data,status) {
				showRet(data);
			});
        });
        $("#btn-ajax-get-nodejs").click(function(){
            var myObj = { "name":"John", "age":32, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.get("http://" + host + ":8080/a?" + myJSON, function(data,status) {
				showRet(data);
			});
        });
        $("#btn-ajax-post-nodejs").click(function(){
            var myObj = { "name":"John", "age":33, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.post("http://" + host + ":8080/", myJSON, function(data,status) {
				showRet(data);
			});
        });
        $("#clickButton").click(function() {
			$("#teste").html("<p>Hello JavaScript!</p>");
			showMsg("Comando enviado com sucesso");               
        });
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
			<div id="app2" class="col-sm-12">
				<b>{{ msg1 }}</b> ou <i>{{ msg2 }}</i>
				<span v-bind:class="msg3">Teste de Atributo</span>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-12 jumbotron">
				<p>
				<h1>Testing 
        		<span id="app1" class="vue-js">
            		{{ msg }}
        		</span>
        		and 
        		<span class="php">
        		<?php
    		      echo("PHP !!!");
    	        ?>
        		</span>
				</h1>
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
        		<button id="clickButton" type="button" class="btn btn-primary btn-lg btn-block">Click Me!</button>
		        <div id="teste">
        		</div>
        		<p></p>
        	</div>
			<div class="col-sm-4">
                <div class="btn-group-vertical btn-block">
					<button id="btn-ajax-get-php" class="btn btn-primary btn-block" type="button">Call AJAX JSON GET PHP</button>
                	<button id="btn-ajax-post-php" class="btn btn-secondary btn-block" type="button">Call AJAX JSON POST PHP</button>
                </div>
				<p></p>
                <div class="btn-group-vertical btn-block">
					<button id="btn-ajax-get-nodejs" class="btn btn-primary btn-block" type="button">Call AJAX JSON GET NodeJS</button>
    	            <button id="btn-ajax-post-nodejs" class="btn btn-secondary btn-block" type="button">Call AJAX JSON NodeJS</button>
				</div>
			</div>
			<div class="col-sm-6">
		        <div id="ret"></div>
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


