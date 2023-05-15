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
    $password = isset($mydataa['password']) ? $mydataa['password'] : '';
    $position = isset($mydataa['position']) ? $mydataa['position'] : '';
    $image = isset($mydataa['image']) ? $mydataa['image'] : '';

    $valid = validate($tc, $name, $surname, $position, $mobile, $image, $email);

    if($valid == ''){
        
        $name = ucwords($name);
        $surname = ucwords($surname);

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        $sqlstr = "INSERT INTO " . $GLOBALS['table'] . " (`id`, `tc`, `name`, `surname`, `mobile`, `email`, `password`, `position`, `image`) 
        VALUES ('$id', '$tc', '$name', '$surname', '$mobile', '$email', '$password', '$position', '$image');";
        
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