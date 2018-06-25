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
    var host = "localhost"; //"192.168.0.52"; 
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
        $("p").click(function(){
            $(this).hide();
        });
        $("#btn-ajax-get-php").click(function(){
            var myObj = { "name":"John", "age":32, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.get("demo_json.php?" + myJSON, function(data,status) {
				var myObj = JSON.parse(data);
				$("#ret").html("<p>Nome: " + myObj.name 
						+ "<p>Idade: " + myObj.age + "<p>Cidade: "
						+ myObj.city);
			});
        });
        $("#btn-ajax-post-php").click(function(){
            var myObj = { "name":"John", "age":33, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.post("demo_json.php", myJSON, function(data,status) {
				var myObj = JSON.parse(data);
				$("#ret").html("<p>Nome: " + myObj.name 
						+ "<p>Idade: " + myObj.age + "<p>Cidade: "
						+ myObj.city);
			});
        });
        $("#btn-ajax-get-nodejs").click(function(){
            var myObj = { "name":"John", "age":32, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.get("http://" + host + ":8080/a?" + myJSON, function(data,status) {
				var myObj = JSON.parse(data);
				$("#ret").html("<p>Nome: " + myObj.name 
						+ "<p>Idade: " + myObj.age + "<p>Cidade: "
						+ myObj.city);
			});
        });
        $("#btn-ajax-post-nodejs").click(function(){
            var myObj = { "name":"John", "age":33, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.post("http://" + host + ":8080/", myJSON, function(data,status) {
				var myObj = JSON.parse(data);
				$("#ret").html("<p>Nome: " + myObj.name 
						+ "<p>Idade: " + myObj.age + "<p>Cidade: "
						+ myObj.city);
			});
        });
    });
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
			<div class="col-sm-12">
				<p>Testing 
        		<span id="app1" class="vue-js">
            		{{ msg }}
        		</span>
        		and
        		<span class="php">
        		<?php
    		      echo("PHP !!!");
    	        ?>
        		</span>
        		<p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
        		<div id="app" class="vue-js">
            		<p>{{ message }}</p>
        		</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
        		<button type="button" onclick='document.getElementById("teste").innerHTML = "&lt;p&gt;Hello JavaScript!&lt;/p&gt;"'>Click Me!</button>
		        <div id="teste">
        		</div>
        	</div>
			<div class="col-sm-4">
                <button id="btn-ajax-get-php" type="button">Call AJAX JSON GET PHP</button><br>
                <button id="btn-ajax-post-php" type="button">Call AJAX JSON POST PHP</button><br>
                <button id="btn-ajax-get-nodejs" type="button">Call AJAX JSON GET NodeJS</button><br>
                <button id="btn-ajax-post-nodejs" type="button">Call AJAX JSON NodeJS</button><br>
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


