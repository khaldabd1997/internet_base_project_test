<?php

require('conn_config.php');
require('validation.php');

if($requestMethod == 'POST'){
    edt_user();
}else{
    header("HTTP/1.0 405 Method Not Allowed");
}

function edt_user(){

    $mydataa = json_decode(file_get_contents('php://input'), true);

    $id = isset($mydataa['id']) ? $mydataa['id'] : '';
    $tc = isset($mydataa['tc']) ? $mydataa['tc'] : '';
    $name = isset($mydataa['name']) ? $mydataa['name'] : '';
    $surname = isset($mydataa['surname']) ? $mydataa['surname'] : '';
    $mobile = isset($mydataa['mobile']) ? $mydataa['mobile'] : '';
    $email = isset($mydataa['email']) ? $mydataa['email'] : '';
    $department = isset($mydataa['department']) ? $mydataa['department'] : '';
    $image = isset($mydataa['image']) ? $mydataa['image'] : '';

    $valid = validate($tc, $name, $surname, $department, $mobile, $image, $email);

    if($valid == ''){
        
        $name = ucwords($name);
        $surname = ucwords($surname);

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        
        $sqlstr1 = "UPDATE " . $GLOBALS['table'] . " SET
        `tc`='$tc', `name`='$name', `surname`='$surname', `mobile`='$mobile', `email`='$email', `department`='$department'
        WHERE `id`='$id'";

        $sqlstr2 = "UPDATE `employees` SET
        `image`='$image' 
        WHERE `id`='$id'";
        
        $conn->query($sqlstr1);
        
        if($image){
            $conn->query($sqlstr2);
        }

        header('Content-type: application/json');
        $response = '{"response" : "Edit Done"}';
    }else{
        header('Content-type: application/json');
        header("HTTP/1.0 400 Bad Request");
        $response = '{"response" : "'. $valid .'"}';
    }
    
    echo $response;
}