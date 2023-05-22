<?php

require('conn_config.php');

if($requestMethod == 'POST'){
    edt_pass();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function edt_pass(){

    $mydataa = json_decode(file_get_contents('php://input'), true);

    $new = $mydataa['new'];
    $old = $mydataa['old'];
    $id = $_SESSION['id'];

    $valid = $mydataa['old'] == $_SESSION['password'] ? true : false;

    if($valid){
        
        $name = ucwords($name);
        $surname = ucwords($surname);

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        
        $sqlstr1 = "UPDATE " . $GLOBALS['table'] . " SET `password` = '$new' WHERE `id` = '$id'";

        $conn->query($sqlstr1);

        header('Content-type: application/json');
        $response = '{"response" : "Edit Done"}';
    }else{
        header('Content-type: application/json');
        header("HTTP/1.0 400 Bad Request");
    }
}