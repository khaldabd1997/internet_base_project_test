<?php

require('conn_config.php');
//require('validation.php');

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
    $sender_id = $_SESSION['id'];//isset($mydataa['sender_id']) ? $mydataa['sender_id'] : '';
    $receiver_id = isset($mydataa['receiver_id']) ? $mydataa['receiver_id'] : '';
    $date = isset($mydataa['date']) ? $mydataa['date'] : '';
    $time = isset($mydataa['time']) ? $mydataa['time'] : '';
    $message = isset($mydataa['message']) ? $mydataa['message'] : '';
    $is_read = 0;//isset($mydataa['is_read']) ? $mydataa['is_read'] : '';
    $sender_name = $_SESSION['name'] . " " . $_SESSION['surname'];//isset($mydataa['sender_name']) ? $mydataa['sender_name'] : '';
    $receiver_name = isset($mydataa['receiver_name']) ? $mydataa['receiver_name'] : '';
    $subject = isset($mydataa['subject']) ? $mydataa['subject'] : '';

    $valid = '';//validate($sender_id, $receiver_id, $date, $sender_name, $time, $receiver_name, $message);

    if($valid == ''){

        $conn = mysqli_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password'],$GLOBALS['db']) or die("Error " . mysqli_error($conn));
        $sqlstr = "INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `date`, `time`, `message`, `is_read`, `sender_name`, `receiver_name`, `subject`) 
        VALUES ('$id', '$sender_id', '$receiver_id', '$date', '$time', '$message', '$is_read', '$sender_name', '$receiver_name', '$subject');";
        
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