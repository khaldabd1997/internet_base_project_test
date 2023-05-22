<?php

require('conn_config.php');

if($requestMethod == 'POST'){
    edt_user();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function edt_user(){

    $mydataa = json_decode(file_get_contents('php://input'), true);

    $id = isset($mydataa['id']) ? $mydataa['id'] : '';
    $name = isset($mydataa['name']) ? $mydataa['name'] : '';
    $date = isset($mydataa['date']) ? $mydataa['date'] : '';
    $time = isset($mydataa['time']) ? $mydataa['time'] : '';
    $duration = isset($mydataa['duration']) ? $mydataa['duration'] : '';
    $lecturer = isset($mydataa['lecturer']) ? $mydataa['lecturer'] : '';

    $valid = '';
    
    if($valid == ''){

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        
        $sqlstr1 = "UPDATE " . $GLOBALS['table'] . " SET
        `name`='$name', `date`='$date', `date`='$date', `time`='$time', `duration`='$duration', `lecturer`='$lecturer'
        WHERE `id`='$id'";
        
        $conn->query($sqlstr1);
        

        header('Content-type: application/json');
        $response = '{"response" : "Edit Done"}';
    }else{
        header('Content-type: application/json');
        header("HTTP/1.0 400 Bad Request");
        $response = '{"response" : "'. $valid .'"}';
    }
    
    echo $response;
}