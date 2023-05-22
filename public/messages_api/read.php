<?php

require('conn_config.php');
//require('validation.php');

if($requestMethod == 'GET'){
    change_read();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function change_read(){
    $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr = "UPDATE `messages` SET is_read = 1 WHERE id = '" . $_GET['id'] . "'";
    
    $conn->query($sqlstr);
}