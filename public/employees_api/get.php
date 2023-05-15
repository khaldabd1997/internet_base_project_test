<?php

require('conn_config.php');

if($requestMethod == 'GET'){
    if(isset($_GET['id'])){
        get_user($_GET['id']);
    }else{
        get_user(null);
    }
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function get_user($i){
    $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr = "SELECT * FROM employees ORDER BY name";
    $sqldata = mysqli_query($conn, $sqlstr) or die("Error in Selecting " . mysqli_error($conn));
    $emparray = array();

    while($row = mysqli_fetch_assoc($sqldata))
    {
        $emparray[] = $row;
    }

    $myjson = isset($i) ? json_encode($emparray[$i]) : json_encode($emparray);

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    echo $myjson;
}