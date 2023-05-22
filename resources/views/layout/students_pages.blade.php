<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_name', 'Page')</title>
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
                        <button onclick="window.location.href='student-main'" id="@yield('main_active', '')">
                            <div><img alt="Image not found" src="@yield('home_icon', 'storage/images/icons/home-icon.svg')"></div>
                            <div style="margin-left: 10px;">Home Page</div>
                        </button>
                        <button onclick="window.location.href='student-info'" id="@yield('info_active', '')">
                            <div><img alt="Image not found" src="@yield('statistic_icon', 'storage/images/icons/statistic-icon.svg')"></div>
                            <div style="margin-left: 10px;">Personal Infos</div>
                        </button>
                        <button onclick="window.location.href='student-activities'" id="@yield('activities_active', '')">
                            <div><img alt="Image not found" src="@yield('activities_icon', 'storage/images/icons/activities-icon.svg')"></div>
                            <div style="margin-left: 10px;">Activities</div>
                        </button>
                        <button onclick="window.location.href='student-messages'" id="@yield('messages_active', '')">
                            <div><img alt="Image not found" src="@yield('mail_icon', 'storage/images/icons/mail-icon.svg')"></div>
                            <div style="margin-left: 10px;">Messages</div>
                        </button>
                        <button onclick="window.location.href='student-password'" id="@yield('password_active', '')">
                            <div><img alt="Image not found" src="@yield('password_icon', 'storage/images/icons/password-icon.svg')"></div>
                            <div style="margin-left: 10px;">Change Password</div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 main" style="padding: 0px">
                <nav class="navbar-pages">
                    <div class="navbar-div">
                        <div class="navbar-center">
                            @yield('page_name', 'Page')
                        </div>
                        <div class="navbar-right">
                            <img class="personal-img-sml"  alt="Image not found" src='{{$_SESSION['image'] ? $_SESSION['image'] : "storage/images/user-img.png"}}' width="35px" height="35px">
                            <div>
                                <p><b>{{ $_SESSION['name'] }} {{ $_SESSION['surname'] }}</b></p>
                                <p>Student</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='authenticate/logout_process.php'"
                                    class="btn btn-blu" name="Logout"
                                    style="padding:8px; margin-left:20px; background-color:rgb(201, 44, 44)">></button>
                            </div>
                        </div>
                    </div>
                </nav>
                @yield('body')
            </div>
        </div>
    </div>
</body>

<style>
    /*----------------------------------------navbar----------------------------------------*/

    .navbar-pages {
        height: 60px;
        width: 100%;
        position: relative;
        display: flex;
        flex-flow: row;
        align-items: center;
        border-bottom-width: 0.5px;
        border-top-width: 0px;
        border-right-width: 0px;
        border-left-width: 0px;
        border-style: solid;
        border-color: darkgray;
    }

    .navbar-brand {
        color: #FAB000;
        font-weight: bold;
    }

    .navbar-left {
        height: 60px;
        width: 100%;
        position: relative;
        display: flex;
        flex-flow: row;
        align-items: center;
        border-bottom-width: 0.5px;
        border-top-width: 0px;
        border-right-width: 0px;
        border-left-width: 0px;
        border-style: solid;
        border-color: darkgray;
        justify-content: center;
    }

    .navbar-div {
        display: flex;
        flex-flow: row;
        align-items: center;
        width: 100%;
    }

    .navbar-center {
        width: 80%;
        display: flex;
        flex-flow: row;
        justify-content: center;
    }

    .navbar-right {
        width: 20%;
        display: flex;
        flex-flow: row;
        border-style: solid;
        border-width: 00px;
        border-left-width: 0.5px;
        border-color: darkgray;
    }

    .navbar-right img {
        margin-right: 7%;
        margin-left: 7%;
    }

    .navbar-right p {
        margin: 0px;
        padding: 0px;
        font-size: 0.8em;
    }

    /*----------------------------------------pages----------------------------------------*/

    .main {
        margin-left: 16.666%;
    }

    .side-bar {
        border-style: solid;
        border-left-width: 0px;
        border-bottom-width: 0px;
        border-top-width: 0px;
        border-right-width: 1px;
        border-color: darkgray;
        height: 100vh;
        padding: 0px;
        position: fixed;
    }

    @media screen and (max-width:576px) {
        .side-bar {
            position: relative;
            height: 100%;
        }

        .main {
            margin: 0px;
        }
    }

    .side-list {
        padding-top: 20px;
        padding-left: 5%;
        padding-right: 5%;
    }

    .side-list button {
        width: 100%;
        height: 30px;
        text-align: left;
        margin-top: 10px;
        border-style: solid;
        border-width: 1px;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 10px;
        padding-right: 25px;
        border-radius: 7px;
        border-width: 0px;
        background-color: rgba(0, 0, 0, 0);
        color: dimgrey;
        font-size: 0.85em;
        display: flex;
        flex-flow: row;
        align-items: center;
    }

    .side-list button span {
        margin-right: 15px;
    }

    .side-list button:active,
    .side-list button:hover,
    #active-button {
        background-color: #FDF2DA;
        color: #FAB000;
    }

    .main-employees {
        height: 100vh;
        padding: 30px;
        padding-top: 15px;
    }

    .personal-img-sml {
        border-radius: 17px;
    }
    .personal-img-sml {
        border-radius: 17px;
    }
</style>
