<?php

require('conn_config.php');

if($requestMethod == 'POST'){
    delete_user();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function delete_user(){
    header('Access-Control-Allow-Origin: *');

    $mydataa = json_decode(file_get_contents('php://input'), true);
    $ii = $mydataa['id'];
    $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr = "DELETE FROM " . $GLOBALS['table'] . " WHERE id='$ii'";
    $conn->query($sqlstr);

    echo '{"response" : "Delete Done"}';
}