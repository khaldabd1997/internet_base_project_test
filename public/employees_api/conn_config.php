<?php

session_start();

$host = "";
$username = "";
$password = "";
$db = "";

if($_SESSION['loggedin']){

    $GLOBALS['host'] = "localhost";
    $GLOBALS['username'] = "root";
    $GLOBALS['password'] = "asdrasdr1";
    $GLOBALS['db'] = "management";
    $GLOBALS['table'] = "employees";
    
    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *');
    
    $requestMethod = $_SERVER["REQUEST_METHOD"];

}else{
    header('Content-type: application/json');
    header("HTTP/1.0 400 Bad Request");
    $response = '{"response" : "Session is timeout"}';
    echo $response;
}