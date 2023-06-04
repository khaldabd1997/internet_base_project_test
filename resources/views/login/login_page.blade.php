<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Admin Sign In</title>
        @include('layout.head')
    </head>
    <body>
        @include('layout.login_navbar')
        <div class="container-fluid text-center" id="login-main-container">
            <div class="row">
                <div class="col-lg-7">
                    <img id="back-img" src="storage/images/login%20background.svg" alt="Image not found">
                </div>
                <div class="col-lg-5" id="login-col">
                    <div id="loginBox">
                        <h2 style="color:#313131; padding: 15px;"><b>User Login</b></h2>
                        <div>
                            <form action="authenticate/login_process.php" method="POST" id="signin-form">
                                <div style="color:white ;width:100%; display:flex; flex-flow:row; justify-content:center">
                                    <label class="type" style="margin-right:20px; background-color:#1583c7; padding:3%; border-radius:7px;">Employee <input type="radio" name="usertype" value="employee" checked="checked" required></label>
                                    <label class="type" style="margin-right:20px; background-color:#1583c7; padding:3%; border-radius:7px;">Student <input type="radio" name="usertype" value="student" required></label>
                                </div>
                                <input id="username" name="username" type="text" class="login-fields">
                                <input id="password" name="password" type="password" class="login-fields">
                                <input type="submit" title="Login" value="Login" class="login-fields submit">
                                <p id='error'></p>
                                <a><h6 style="margin-top: 25px; font-weight: lighter;">Forget Username or Password</h6></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>