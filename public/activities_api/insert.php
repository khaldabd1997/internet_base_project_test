<?php

require('conn_config.php');

if($requestMethod == 'POST'){
    set_user();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function set_user(){
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $mydataa = json_decode(file_get_contents('php://input'), true);

    //$id = isset($mydataa['id']) ? $mydataa['id'] : '';
    $id = uniqid();
    $name = isset($mydataa['name']) ? $mydataa['name'] : '';
    $date = isset($mydataa['date']) ? $mydataa['date'] : '';
    $time = isset($mydataa['time']) ? $mydataa['time'] : '';
    $duration = isset($mydataa['duration']) ? $mydataa['duration'] : '';
    $lecturer = isset($mydataa['lecturer']) ? $mydataa['lecturer'] : '';

    $valid = '';
    
    if($valid == ''){

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        $sqlstr = "INSERT INTO " . $GLOBALS['table'] . " (`id`, `name`, `date`, `time`, `duration`, `lecturer`) 
        VALUES ('$id', '$name', '$date', '$time', '$duration', '$lecturer');";
        
        $conn->query($sqlstr);

        header('Content-type: application/json');
        $response = '{"response" : "Post Done"}';
    }else{
        header('Content-type: application/json');
        header("HTTP/1.0 400 Bad Request");
        $response = '{"response" : "'. $valid .'"}';
    }
    
    echo $response;
}