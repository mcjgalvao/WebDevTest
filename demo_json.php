<?php
    //echo("Testando 3!!!!<p>");
    //print_r($_GET);
    //echo("QUERY_STRING:".$_SERVER['QUERY_STRING']."<p>");
    $obj = json_decode(urldecode($_SERVER['QUERY_STRING']));
    //echo("obj:");
    //print_r($obj);
    //echo("<p>Name:".$obj->name);
    $obj->age++;
    echo(json_encode($obj));
?>