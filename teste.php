<!DOCTYPE html>
<!-- HTML5 -->
<html>
<head>
	<title></title>
    <script src="./script/jquery-3.3.1.js"></script>
	<script src="./script/vue.js"></script>
    <script>
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
        $("#btn-ajax").click(function(){
            var myObj = { "name":"John", "age":32, "city":"NewYork" };
            var myJSON = JSON.stringify(myObj);
			$.get("demo_json.php?" + myJSON, function(data,status) {
				var myObj = JSON.parse(data);
				$("#ret").html("Nome: " + myObj.name 
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
        
    <div id="app" class="vue-js">
        <p>{{ message }}</p>
    </div>
    
    <button type="button" onclick='document.getElementById("teste").innerHTML = "&lt;p&gt;Hello JavaScript!&lt;/p&gt;"'>Click Me!</button>
    
    <div id="teste">
    </div>

    <button id="btn-ajax" type="button">Call AJAX JSON</button>
    
    <div id="ret"></div>
    <?php     
        //phpinfo();
	?>
	
	<script>
		console.log(5 + 6);
		console.log("Testando...");
	</script>
</body>
</html>


