<?php

require('conn_config.php');
require('validation.php');

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
        $password = substr($tc, 0, 5) . 'K';

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        $sqlstr = "INSERT INTO " . $GLOBALS['table'] . " (`id`, `tc`, `name`, `surname`, `mobile`, `email`, `password`, `department`, `image`) 
        VALUES ('$id', '$tc', '$name', '$surname', '$mobile', '$email', '$password', '$department', '$image');";
        
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