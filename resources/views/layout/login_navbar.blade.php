<nav class="navbar-main">
    <div class="navbar-div">
        <div class="navbar-main-left">
            <img src="storage/images/Logo.png" alt="Image not found" width="50">
            <a class="navbar-brand" href="#"><b>ASIL VAKFI</b></a>
        </div>
        <div class="navbar-main-center">
            <div><b><a>Login</a></b></div>
            <div><a>Donate</a></div>
            <div><a>Our Projects</a></div>
            <div><a>About Us</a></div>
            <div><a>Search</a></div>
        </div>
        <div class="navbar-main-right">
            <button class="btn btn-ylo">Admin Login</button>
        </div>
    </div>
</nav>

<style>
    /*-------------------------------------navbar-------------------------------*/

    .nav-link:active {
        font-weight: bold;
    }

    .navbar-main {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        background-color: #ffffff;
        padding-left: 80px;
        padding-right: 80px;
        /*padding-top: 30px;
        padding-bottom: 30px;*/
        position: fixed;
        width: 100%;
        height: 60px;
        display: flex;
        flex-flow: row;
        align-items: center;
    }

    .navbar-main-center {
        width: 60%;
        display: flex;
        flex-flow: row;
        justify-content: left;
    }

    .navbar-main-center>div {
        margin-left: 7%;
    }

    .navbar-main-right {
        width: 20%;
        display: flex;
        flex-flow: row;
        justify-content: right;
    }

    .navbar-main-left {
        width: 20%;
        display: flex;
        flex-flow: row;
        justify-content: left;
        align-items: center;
    }

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

    .login-fields {
        margin-top: 20px;
        width: 100%;
        height: 50px;
        border-radius: 15px;
        border-style: solid;
        border-width: 0.5px;
        border-color: darkgray;
    }

    .login-fields:hover {
        margin-top: 25px;
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

    /*------------------------------------body-----------------------------*/

    #loginBox {
        margin-top: 150px;
        border-style: solid;
        border-width: 0px;
        border-radius: 15px;
        border-color: darkgray;
        background-color: rgba(255, 255, 255, 0.747);
        padding: 25px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .submit {
        background-color: #F9CD6A;
        border-width: 0px;
        color: white;
        font-weight: bold;
    }

    .submit:hover {
        background-color: #FAB000
    }

    #login-main-container {
        margin-left: 0px;
        margin-right: 500px;
        padding-left: 0px;
        padding-right: 0px;
        width: 100%;
        height: 100vh;
    }

    @media screen and (min-width: 992px) {
        #login-col {
            padding-right: 5%;
            padding-left: 5%;
        }
    }

    @media screen and (max-width: 991px) {
        #login-col {
            margin-top: -600px;
        }
    }

    #login-col {
        padding-right: 5%;
        padding-left: 5%;
    }
</style>
