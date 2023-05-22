<?php 

$requestMethod = $_SERVER["REQUEST_METHOD"];

require('conn_config.php');

if($requestMethod == 'POST' and isset($_POST['username']) and isset($_POST['password'])){
    switch($_POST['usertype']){
        case 'employee':
            employee();
            break;

        case 'student':
            student();
            break;

        default:
            back();
    }
}else
    back();

function employee(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect($GLOBALS['host'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr = "SELECT * FROM employees WHERE tc = '$username'";
    $sqldata = mysqli_query($conn, $sqlstr) or die("Error in Selecting " . mysqli_error($conn));
    $emparray = array();

    while($row = mysqli_fetch_assoc($sqldata)){
            $emparray[] = $row;
    }

    if($emparray[0]['password'] === $password){
        session_start();
        
        $_SESSION['loggedin'] = true;
        $_SESSION['type'] = 1;

        $_SESSION['id'] = $emparray[0]['id'];
        $_SESSION['tc'] = $emparray[0]['tc'];
        $_SESSION['name'] = $emparray[0]['name'];
        $_SESSION['surname'] = $emparray[0]['surname'];
        $_SESSION['mobile'] = $emparray[0]['mobile'];
        $_SESSION['email'] = $emparray[0]['email'];
        $_SESSION['position'] = $emparray[0]['position'];
        $_SESSION['image'] = $emparray[0]['image'];
        $_SESSION['password'] = $emparray[0]['password'];

        header("location:../employee-main");
    }else
    back();
}

function student(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $conn = mysqli_connect($GLOBALS['host'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db']) or die("Error " . mysqli_error($conn));
    $sqlstr = "SELECT * FROM students WHERE tc = '$username'";
    $sqldata = mysqli_query($conn, $sqlstr) or die("Error in Selecting " . mysqli_error($conn));
    $emparray = array();

    while($row = mysqli_fetch_assoc($sqldata)){
            $emparray[] = $row;
    }

    if($emparray[0]['password'] === $password){
        session_start();
        
        $_SESSION['loggedin'] = true;
        $_SESSION['type'] = 2;

        $_SESSION['id'] = $emparray[0]['id'];
        $_SESSION['tc'] = $emparray[0]['tc'];
        $_SESSION['name'] = $emparray[0]['name'];
        $_SESSION['surname'] = $emparray[0]['surname'];
        $_SESSION['mobile'] = $emparray[0]['mobile'];
        $_SESSION['email'] = $emparray[0]['email'];
        $_SESSION['depatment'] = $emparray[0]['depatment'];
        $_SESSION['image'] = $emparray[0]['image'];
        $_SESSION['password'] = $emparray[0]['password'];

        header("location:../student-main");
    }else
    back();
}

function back(){
    header("location:../login");
    exit;
}