<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    echo "Logged out";
    header("location:../login");
}else{
    $id = $_SESSION['id'];
    $tc = $_SESSION['tc'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $mobile = $_SESSION['mobile'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    $image = $_SESSION['image'];

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
                        <button onclick="window.location.href='employee-main'"><div><img alt="Image not found" src="storage/images/icons/home-icon.svg"></div><div style="margin-left: 10px;">Home Page</div></button>
                        <button onclick="window.location.href='employee-students-list'"><div><img src="storage/images/icons/users-icon.svg"></div><div style="margin-left: 10px;">Students List</div></button>
                        <button onclick="window.location.href='employee-info'" id="active-button"><div><img alt="Image not found" src="storage/images/icons/statistic-icon-active.svg"></div><div style="margin-left: 10px;">Personal Infos</div></button>
                        <button onclick="window.location.href='employee-activities'"><div><img alt="Image not found" src="storage/images/icons/activities-icon.svg"></div><div style="margin-left: 10px;">Activities</div></button>
                        <button onclick="window.location.href='employee-messages'"><div><img alt="Image not found" src="storage/images/icons/mail-icon.svg"></div><div style="margin-left: 10px;">Messages</div></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 main" style="padding: 0px">
                <nav class="navbar-pages">
                    <div class="navbar-div">
                        <div class="navbar-center">
                            Personal Infos
                        </div>
                        <div class="navbar-right">
                            <img alt="Image not found" src="storage/images/user-img.png" width="35px" height="35px">
                            <div>
                                <p><b>{{$id}}</b></p>
                                <p>Student</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='authenticate/logout_process.php'" class="btn btn-blu" name="Logout" style="padding:8px; margin-left:20px; background-color:rgb(201, 44, 44)">></button>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="main-top-button">
                    <!-- div style="margin-right: 1%;"><button class="btn btn-narrow btn-red">Delete</button></div -->
                    <div><button class="btn btn-blu" id="edit-button">Edit my Infos</button></div>
                </div>
                <div class="main-employees">
                    <div class="my-border">
                        <div class="popup-header">
                            <div style="width: 95%"><b style="margin-left:5%">User Infos</b></div>
                        </div>
                        <div class="popup-content">
                            <div>
                                <div class="popup-content-col1">
                                    <div class="popup-content-div" style="margin-top: 0px">
                                        <p><b>TC</b></p>
                                        <div class="popup-field" id="add-user-tc">{{$tc}}</div>
                                    </div>
                                    <div class="popup-content-div">
                                        <p><b>Name</b></p>
                                        <div class="popup-field" id="add-user-name">{{$name}}</div>
                                    </div>
                                    <div class="popup-content-div">
                                        <p><b>Surname</b></p>
                                        <div class="popup-field" id="add-user-surname">{{$surname}}</div>
                                    </div>
                                </div>
                                <div class="popup-content-col1">
                                    <div class="popup-content-div">
                                        <p><b>Position</b></p>
                                        <div class="popup-field" id="add-user-position">{{$position}}</div>
                                    </div>
                                    <div class="popup-content-div">
                                        <p><b>Number</b></p>
                                        <div class="popup-field" id="add-user-number">{{$mobile}}</div>
                                    </div>
                                    <div class="popup-content-div">
                                        <p><b>Email</b></p>
                                        <div class="popup-field" id="add-user-email">{{$email}}</div>
                                    </div>
                                </div>
                                <div class="popup-content-div" id="error-field">
                                </div>
                            </div>
                            <div class="popup-content-col2">
                                <div class="popup-content-div">
                                    <img src={{$image ? $image :'storage/images/personal.png'}} class="my-border personal-img" id="personal-img" width="200px" height="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let url = '/employees_api';

        function edit_user_window(){
            const blur_genel = document.querySelector('#blur-genel');
            blur_genel.innerHTML = `<div class="blur"></div>`;

            blur_genel.addEventListener('click', event => {
                genel.innerHTML = ``;
                blur_genel.innerHTML = ``;
                /*genel.remove();
                blur_genel.remove();*/
            })

            const genel = document.querySelector('#popup-genel');
            genel.innerHTML = `
                <div class="popup my-border">
                        <div class="popup-header">
                            <div style="width: 95%"><b style="margin-left:5%">Edit User</b></div>
                        </div>
                        <div class="popup-content">
                            <div class="popup-content-col1">
                                <div class="popup-content-div" style="margin-top: 0px">
                                    <p><b>TC</b></p>
                                    <!-- div class="popup-field" id="add-user-tc">{{$tc}}</div -->
                                    <input class="popup-field" type="text" id="add-user-tc" value="{{$tc}}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Name</b></p>
                                    <input class="popup-field" type="text" id="add-user-name"  value="{{$name}}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Surname</b></p>
                                    <input class="popup-field" type="text" id="add-user-surname"  value="{{$surname}}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Position</b></p>
                                    <!-- input type="text" class="popup-field" id="add-user-position" -->
                                    <select name="position" value="2" class="popup-field" id="add-user-position">
                                        <option value="{{$position}}" selected disabled hidden>{{$position}}</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Number</b></p>
                                    <input class="popup-field" type="text" id="add-user-number"  value="{{$mobile}}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Email</b></p>
                                    <input class="popup-field" type="text" id="add-user-email"  value="{{$email}}">
                                </div>
                                <div class="popup-content-div" id="error-field">
                                </div>
                            </div>
                            <div class="popup-content-col2">
                                <div class="popup-content-div">
                                    <img src={{$image ? $image :'storage/images/personal.png'}} class="my-border personal-img" id="personal-img" width="200px" height="200px">
                                </div>
                                <div class="popup-content-div">
                                    <label class="btn btn-ylo">
                                        <input type="file" style="display:None;" onchange="fileChange()" id="input_img" accept="image/*" ><span>Change Image</span>
                                    </label>
                                </div>
                                <div class="popup-content-div">
                                    <button class="btn btn-blu" id="confirm-button">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `

                edt_user('{{$id}}');
        }

        const edt_btn = document.querySelector('#edit-button');
        edt_btn.addEventListener('click', event =>{
            edit_user_window()
        })

        async function edt_user(id){

        const confirm_button = document.querySelector('#confirm-button');
        confirm_button.addEventListener('click', event => {handling()})

        const box = document.querySelector('.popup');
        box.addEventListener('keypress', e => {
            if(e.key == 'Enter')
            handling();
        });

        async function handling(){

            let my_tc = document.querySelector('#add-user-tc').value.toString();
            let my_name = document.querySelector('#add-user-name').value.toString();
            let my_surname = document.querySelector('#add-user-surname').value.toString();
            let my_pos = document.querySelector('#add-user-position').value.toString();
            let my_num = document.querySelector('#add-user-number').value.toString();
            let my_email = document.querySelector('#add-user-email').value.toString();
            let my_img = document.querySelector('#input_img').files['0'] ? await window.set_img() : '';
            
            /*if(my_img){
                my_img = await window.set_img();
            }else{
                my_img = document.querySelector('#personal-img').src;
            }*/

            $.ajax({
                type: "POST",
                url: `${url}/edit.php`,
                data: JSON.stringify({
                    "id" : id,
                    "tc" : my_tc,
                    "name" : my_name,
                    "surname" : my_surname,
                    "position" : my_pos,
                    "mobile" : my_num,
                    "email" : my_email,
                    "image" : my_img
                }),
                success: function(data){
                    //console.log(data);
                    close_popup();
                },
                error: function(resp, textStatus){
                    alert(resp.responseJSON.response);
                },
                processData:false
            });
        }
        }

        function close_popup(){
            const blur_genel = document.querySelector('#blur-genel');
            const genel = document.querySelector('#popup-genel');
            blur_genel.innerHTML = ``;
            genel.innerHTML = ``;
        }

        function fileChange(){
            const file = document.querySelector('#input_img');
            const img = document.querySelector('#personal-img');

            img.src = URL.createObjectURL(file.files[0]);
        }

        async function set_img(){
            const file = document.querySelector('#input_img');
            let img_path;

            let form = new FormData();
            form.append("image", file.files[0])

            let settings = {
                "url": "https://api.imgbb.com/1/upload?key=970320822cdda035a759590d83b56367",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            await $.ajax(settings).done(function (response) {
                let jx = JSON.parse(response);
                //console.log(jx.data.url);
                img_path = jx.data.url;
            });

            return `${img_path}`;
        }

    </script>

</body>

<?php } ?>