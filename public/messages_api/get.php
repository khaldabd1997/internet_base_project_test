<?php

require('conn_config.php');

if($requestMethod == 'GET' and isset($_GET['id'])){
    get_user($_GET['id']);
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function get_user($i){
    $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr1 = "SELECT * FROM messages WHERE `receiver_id` = '$i'";
    $sqldata1 = mysqli_query($conn, $sqlstr1) or die("Error in Selecting " . mysqli_error($conn));
    $emparray1 = array();
    $emparray2 = array();

    while($row = mysqli_fetch_assoc($sqldata1))
    {
        $emparray1[] = $row;
    }

    $myjson = isset($i) ? json_encode($emparray1) : json_encode($emparray1);

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    echo $myjson;
}