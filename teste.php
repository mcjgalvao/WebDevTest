<!DOCTYPE html>
<!-- HTML5 -->
<html>
<head>
	<title></title>
	<script src="./script/vue.js"></script>
    <script>
	function myFunction() {
	new Vue({
		  el: '#app',
		  data: {
		    message: 'Hello Vue.js by Marcelo!'
		  }
		});
	}
	</script>
</head>
<body onload="myFunction()">
	<?php
		echo("Hello World 2 !!!");
	?>
    <p>Testing Vue.JS<p>
        
    <div id="app">
        <p>{{ message }}</p>
    </div>
    <?php     
        //phpinfo();
	?>
</body>
</html>


