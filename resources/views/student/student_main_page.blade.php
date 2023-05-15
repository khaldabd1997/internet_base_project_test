<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 2){
    echo "Logged out";
    header("location:../login");
}else{
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    @include('layout.head')
</head>
<body>
    <div id="blur-genel"></div>
    <div id="popup-genel">
        
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 side-bar">
                <div class="navbar-left">
                    <img alt="Image not found" src="storage/images/Logo.png" width="50">
                    <a class="navbar-brand" href="index.html"><b>ASIL VAKFI</b></a>
                </div>
                <div class="side-list">
                    <div>
                        <b>Services</b>
                    </div>
                    <div>
                        <button onclick="window.location.href='student-main'" id="active-button"><div><img alt="Image not found" src="storage/images/icons/home-icon-active.svg"></div><div style="margin-left: 10px;">Home Page</div></button>
                        <button onclick="window.location.href='student-info'"><div><img alt="Image not found" src="storage/images/icons/statistic-icon.svg"></div><div style="margin-left: 10px;">Personal Infos</div></button>
                        <button onclick="window.location.href='student-activities'"><div><img alt="Image not found" src="storage/images/icons/activities-icon.svg"></div><div style="margin-left: 10px;">Activities</div></button>
                        <button onclick="window.location.href='student-messages'"><div><img alt="Image not found" src="storage/images/icons/mail-icon.svg"></div><div style="margin-left: 10px;">Messages</div></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 main" style="padding: 0px">
                <nav class="navbar-pages">
                    <div class="navbar-div">
                        <div class="navbar-center">
                            Home Page
                        </div>
                        <div class="navbar-right">
                            <img alt="Image not found" src="storage/images/user-img.png" width="35px" height="35px">
                            <div>
                                <p><b>{{$name}} {{$surname}}</b></p>
                                <p>Student</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='authenticate/logout_process.php'" class="btn btn-blu" name="Logout" style="padding:8px; margin-left:20px; background-color:rgb(201, 44, 44)">></button>
                            </div>
                        </div>
                    </div>
                </nav>
                
            </div>
        </div>
    </div>

<?php } ?>