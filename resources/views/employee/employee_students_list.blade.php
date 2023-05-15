<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    echo "Logged out";
    header("location:../login");
}else{
    $id = $_SESSION['id'];
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
                        <button onclick="window.location.href='employee-students-list'" id="active-button"><div><img src="storage/images/icons/users-icon-active.svg"></div><div style="margin-left: 10px;">Students List</div></button>
                        <button onclick="window.location.href='employee-info'"><div><img alt="Image not found" src="storage/images/icons/statistic-icon.svg"></div><div style="margin-left: 10px;">Personal Infos</div></button>
                        <button onclick="window.location.href='employee-activities'"><div><img alt="Image not found" src="storage/images/icons/activities-icon.svg"></div><div style="margin-left: 10px;">Activities</div></button>
                        <button onclick="window.location.href='employee-messages'"><div><img alt="Image not found" src="storage/images/icons/mail-icon.svg"></div><div style="margin-left: 10px;">Messages</div></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 main" style="padding: 0px">
                <nav class="navbar-pages">
                    <div class="navbar-div">
                        <div class="navbar-center">
                            Students List
                        </div>
                        <div class="navbar-right">
                            <img alt="Image not found" src="storage/images/user-img.png" width="35px" height="35px">
                            <div>
                                <p><b>{{$id}}</b></p>
                                <p>Employee</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='authenticate/logout_process.php'" class="btn btn-blu" name="Logout" style="padding:8px; margin-left:20px; background-color:rgb(201, 44, 44)">></button>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="main-top-button">
                    <!-- div style="margin-right: 1%;"><button class="btn btn-narrow btn-red">Delete</button></div -->
                    <div><button class="btn btn-blu" id="add-user">Add User</button></div>
                </div>
                <div class="main-employees">
                    <div class="users-menu">
                        <div class="users-menu-header">
                            <div class="users-menu-header-texts">
                                <div class="user-photo">Photo</div>
                                <div class="user-tc">TC</div>
                                <div class="user-name">Name</div>
                                <div class="user-name">Surname</div>
                                <div class="user-position">Position</div>
                                <div class="user-number">Phone Number</div>
                                <!-- div class="user-email">E-mail</div -->
                            </div>  
                        </div>
                        <div class="users-menu-body">
                            <div id="users-menu-body">

                            </div>
                            <div class="users-menu-body-foter">
                                <button class="btn btn-blu" id="prvs-btn">&lt</button>
                                <div id="page-num">1</div>
                                <button class="btn btn-blu" id="nxt-btn">&gt</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let ii = 0;
        let inpg = 10;
        let ff = inpg;
        let pg = 1;
        let pgs = 1;

        let url = '/students_api';

        function users_render (){

            const users_menu_body = document.querySelector('#users-menu-body');
            users_menu_body.innerHTML = "";

            fetch(`${url}/get.php`)
            .then(res => res.json())
            //.then(data => data.forEach(data => {
            .then(dataa => {for(let i = ii; (i<ff && i<dataa.length); i++) {
                let data = dataa[i];
                pgs = Math.ceil(dataa.length/inpg);
                
                const user_photo = document.createElement('div');
                user_photo.className = 'user-photo';
                data.image = data.image ? data.image : 'storage/images/personal.png';
                user_photo.innerHTML = `<img class="personal-img-sml" src="${data.image}" width="34px" height="34px">`;

                const user_tc = document.createElement('div');
                user_tc.className = 'user-tc';
                user_tc.innerText = data.tc;
                const user_name = document.createElement('div');
                user_name.className = 'user-name';
                user_name.innerText = data.name;
                const user_surname = document.createElement('div');
                user_surname.className = 'user-surname';
                user_surname.innerText = data.surname;
                const user_position = document.createElement('div');
                user_position.className = 'user-position';
                user_position.innerText = data.position;
                const user_number = document.createElement('div');
                user_number.className = 'user-number';
                user_number.innerText = data.mobile;
                const user_email = document.createElement('div');
                user_email.className = 'user-email';
                user_email.innerText = data.email;

                const det_btn = document.createElement('button');
                det_btn.className = 'edt-btn btn-ylo';
                det_btn.innerText = 'Details'
                /*const rmv_btn = document.createElement('button');
                rmv_btn.className = 'rmv-btn';
                rmv_btn.innerText = 'Remove'*/

                const user_row_texts = document.createElement('div');
                user_row_texts.className = 'user-row-texts';
                user_row_texts.append(user_photo);
                user_row_texts.append(user_tc);
                user_row_texts.append(user_name);
                user_row_texts.append(user_surname);
                user_row_texts.append(user_position);
                user_row_texts.append(user_number);
                //user_row_texts.append(user_email);

                const user_row_buttons = document.createElement('div');
                user_row_buttons.className = 'user-row-buttons';
                user_row_buttons.append(det_btn);
                //user_row_buttons.append(rmv_btn);

                const users_menu_row = document.createElement('div');
                users_menu_row.className = 'users-menu-row';
                users_menu_row.append(user_row_texts);
                users_menu_row.append(user_row_buttons);

                /*const users_menu_body = document.querySelector('#users-menu-body');
                users_menu_body.innerHTML = ``*/
                users_menu_body.append(users_menu_row);

                const page_num = document.querySelector('#page-num');
                page_num.innerHTML = `${pg} / ${pgs}`;

                det_btn.addEventListener('click', event =>{
                    preview_user_window(data)
                })

            }});
        }

        function nxt_prvs(){
            const page_num = document.querySelector('#page-num');

            const nxt_btn = document.querySelector('#nxt-btn');
            nxt_btn.addEventListener('click', event => {
                if(pg < pgs){
                    ii = ii + inpg;
                    ff = ff + inpg;
                    pg++;
                    users_render();
                    page_num.innerHTML = `${pg} / ${pgs}`;
                }
            })

            const prvs_btn = document.querySelector('#prvs-btn');
            prvs_btn.addEventListener('click', event => {
                if(pg != 1){
                    ii = ii - inpg;
                    ff = ff - inpg;
                    pg--;
                    users_render();
                    page_num.innerHTML = `${pg} / ${pgs}`;
                }
            })
        }

        //-------------------------------------- pop windows ----------------------------------------------

        function add_user_window(){
            const add_user = document.querySelector('#add-user')

            add_user.addEventListener('click', event =>{

                const genel = document.querySelector('#popup-genel');
                genel.innerHTML = `
                <div class="popup my-border">
                        <div class="popup-header">
                            <div style="width: 95%"><b style="margin-left:5%">Add New User</b></div>
                            <div style="width: 5%"><button id="close-button">X</button></div>
                        </div class="popup-content-col1">
                        <div class="popup-content">
                            <div>
                                <div class="popup-content-div" style="margin-top: 0px">
                                    <p><b>TC</b></p>
                                    <input type="text" class="popup-field" id="add-user-tc">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Name</b></p>
                                    <input type="text" class="popup-field" id="add-user-name">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Surname</b></p>
                                    <input type="text" class="popup-field" id="add-user-surname">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Position</b></p>
                                    <!-- input type="text" class="popup-field" id="add-user-position" -->
                                    <select name="position" class="popup-field" id="add-user-position">
                                        <option value="" selected disabled hidden>Please Choose</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Number</b></p>
                                    <input type="text" class="popup-field" id="add-user-number">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Email</b></p>
                                    <input type="text" class="popup-field" id="add-user-email">
                                </div>
                                <div class="popup-content-div" id="error-field">
                                </div>
                            </div>
                            <div class="popup-content-col2">
                                <div class="popup-content-div">
                                    <img src="#" class="my-border personal-img" id="personal-img" width="200px" height="200px">
                                </div>
                                <div class="popup-content-div">
                                    <label class="btn btn-ylo">
                                        <input type="file" style="display:None;" onchange="fileChange()" id="input_img" accept="image/*" ><span>Upload Image</span>
                                    </label>
                                    <!-- button class="btn btn-ylo">Add Photo</button -->
                                </div>
                                <div class="popup-content-div">
                                    <button class="btn btn-blu" id="confirm-button">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `
                
                const blur_genel = document.querySelector('#blur-genel');
                blur_genel.innerHTML = `<div class="blur"></div>`;
                blur_genel.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                    /*genel.remove();
                    blur_genel.remove();*/
                })
                
                const close_button = document.querySelector('#close-button');
                close_button.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                })

                window.add_user();
            })
        }

        function preview_user_window(data){
                const genel = document.querySelector('#popup-genel');
                genel.innerHTML = `
                <div class="popup my-border">
                        <div class="popup-header">
                            <div style="width: 95%"><b style="margin-left:5%">User Infos</b></div>
                            <div style="width: 5%"><button id="close-button">X</button></div>
                        </div>
                        <div class="popup-content">
                            <div class="popup-content-col1">
                                <div class="popup-content-div" style="margin-top: 0px">
                                    <p><b>TC</b></p>
                                    <div class="popup-field" id="add-user-tc">${data.tc}</div>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Name</b></p>
                                    <div class="popup-field" id="add-user-name">${data.name}</div>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Surname</b></p>
                                    <div class="popup-field" id="add-user-surname">${data.surname}</div>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Position</b></p>
                                    <div class="popup-field" id="add-user-position">${data.position}</div>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Number</b></p>
                                    <div class="popup-field" id="add-user-number">${data.mobile}</div>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Email</b></p>
                                    <div class="popup-field" id="add-user-email">${data.email}</div>
                                </div>
                                <div class="popup-content-div" id="error-field">
                                </div>
                            </div>
                            <div class="popup-content-col2">
                                <div class="popup-content-div">
                                    <img src="${data.image ? data.image :'storage/images/personal.png'}" class="my-border personal-img" id="personal-img" width="200px" height="200px">
                                </div>
                                <div class="popup-content-div">
                                    <button class="btn btn-blu" id="edit-button">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `

                const blur_genel = document.querySelector('#blur-genel');
                blur_genel.innerHTML = `<div class="blur"></div>`;

                blur_genel.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                    /*genel.remove();
                    blur_genel.remove();*/
                })

                const close_button = document.querySelector('#close-button');
                close_button.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                })

                const edt_btn = document.querySelector('#edit-button');
                edt_btn.addEventListener('click', event =>{
                    edit_user_window(data)
                })
        }

        function edit_user_window(data){
            const genel = document.querySelector('#popup-genel');
            genel.innerHTML = `
                <div class="popup my-border">
                        <div class="popup-header">
                            <div style="width: 95%"><b style="margin-left:5%">Edit User</b></div>
                            <div style="width: 5%"><button id="close-button">X</button></div>
                        </div>
                        <div class="popup-content">
                            <div class="popup-content-col1">
                                <div class="popup-content-div" style="margin-top: 0px">
                                    <p><b>TC</b></p>
                                    <!-- div class="popup-field" id="add-user-tc">${data.tc}</div -->
                                    <input class="popup-field" type="text" id="add-user-tc" value="${data.tc}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Name</b></p>
                                    <input class="popup-field" type="text" id="add-user-name"  value="${data.name}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Surname</b></p>
                                    <input class="popup-field" type="text" id="add-user-surname"  value="${data.surname}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Position</b></p>
                                    <!-- input type="text" class="popup-field" id="add-user-position" -->
                                    <select name="position" value="2" class="popup-field" id="add-user-position">
                                        <option value="${data.position}" selected disabled hidden>${data.position}</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Number</b></p>
                                    <input class="popup-field" type="text" id="add-user-number"  value="${data.mobile}">
                                </div>
                                <div class="popup-content-div">
                                    <p><b>Email</b></p>
                                    <input class="popup-field" type="text" id="add-user-email"  value="${data.email}">
                                </div>
                                <div class="popup-content-div" id="error-field">
                                </div>
                            </div>
                            <div class="popup-content-col2">
                                <div class="popup-content-div">
                                    <img src="${data.image ? data.image :'storage/images/personal.png'}" class="my-border personal-img" id="personal-img" width="200px" height="200px">
                                </div>
                                <div class="popup-content-div">
                                    <label class="btn btn-ylo">
                                        <input type="file" style="display:None;" onchange="fileChange()" id="input_img" accept="image/*" ><span>Change Image</span>
                                    </label>
                                </div>
                                <div class="popup-content-div">
                                    <button class="btn btn-blu" id="confirm-button">Save Changes</button>
                                </div>
                                <div class="popup-content-div">
                                    <button class="btn btn-narrow btn-red" id="delete-button">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `

                const blur_genel = document.querySelector('#blur-genel');
                blur_genel.innerHTML = `<div class="blur"></div>`;

                blur_genel.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                    /*genel.remove();
                    blur_genel.remove();*/
                })

                const close_button = document.querySelector('#close-button');
                close_button.addEventListener('click', event => {
                    genel.innerHTML = ``;
                    blur_genel.innerHTML = ``;
                })

                edt_user(data.id);
                delete_user(data.id);
        }

        //-------------------------------------- CRUD ----------------------------------------------

        async function add_user(){

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

                $.ajax({
                    type: "POST",
                    url: `${url}/insert.php`,
                    data: JSON.stringify({
                        "tc" : my_tc,
                        "name" : my_name,
                        "surname" : my_surname,
                        "position" : my_pos,
                        "mobile" : my_num,
                        "image" : my_img,
                        "email" : my_email
                    }),
                    success: function(data){
                        //console.log(data);
                        users_render();
                        close_popup();
                    },
                    error: function(resp, textStatus){
                        alert(resp.responseJSON.response);
                    },
                    processData:false
                });
            }
        }

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
                        users_render();
                        close_popup();
                    },
                    error: function(resp, textStatus){
                        alert(resp.responseJSON.response);
                    },
                    processData:false
                });
            }
        }

        function delete_user(id){

            const del_btn = document.querySelector('#delete-button');
            del_btn.addEventListener('click', event => {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: `${url}/delete.php`,
                    data: JSON.stringify({
                        "id" : id
                    }),
                    success: function(data){
                        //console.log(data);
                        users_render();
                        close_popup();
                    },
                    error: function(resp, textStatus){
                        alert(resp.responseJSON.response);
                    },
                    processData:false
                });

                close_popup();
                users_render ();
            })
        }

        //-------------------------------------- image ----------------------------------------------

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

        //-------------------------------------- functions ----------------------------------------------

        function close_popup(){
            const blur_genel = document.querySelector('#blur-genel');
            const genel = document.querySelector('#popup-genel');
            blur_genel.innerHTML = ``;
            genel.innerHTML = ``;
        }

        //------------------------------------------------------------------------------------------------

        function doms(){
            users_render ();
            add_user_window();
            nxt_prvs();
        }

        users_render ();
        add_user_window();
        nxt_prvs();

        //document.addEventListener('DOMContentLoaded',  doms)

    </script>

</body>
</html>

<?php } ?>

