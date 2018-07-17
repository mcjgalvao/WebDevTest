<?php
    //echo("Testando 3!!!!<p>");
    //print_r($_GET);
    //echo("QUERY_STRING:".$_SERVER['QUERY_STRING']."<p>");
    
    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': $jsonData = $_SERVER['QUERY_STRING']; break;
        case 'POST': $jsonData = file_get_contents("php://input"); break;
        default:
    }
    header('Content-Type: text/html'); // application/json
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    $obj = json_decode(urldecode($jsonData));
    //echo("obj:");
    //print_r($obj);
    //echo("<p>Name:".$obj->name);
    $obj->age++;
    echo(json_encode($obj));
?>