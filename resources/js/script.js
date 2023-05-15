let ii = 0;
let inpg = 10;
let ff = inpg;
let pg = 1;
let pgs = 1;
//let url = 'https://asilvakif.000webhostapp.com/api/users_api.php';
let url = 'http://myvh/api/users_api.php';
//let url = 'http://localhost:3000/admin-users';
//let url = 'https://my-json-server.typicode.com/OsamaAnbari/Management-System/admin-users';

function users_render (){
    /*const sub = document.querySelector('#active-button');
    sub.addEventListener('click', event => {
    event.preventDefault();*/
    //const ID = document.querySelector('#searchh');

    const users_menu_body = document.querySelector('#users-menu-body');
    users_menu_body.innerHTML = "";

    fetch(`${url}`)
    .then(res => res.json())
    //.then(data => data.forEach(data => {
    .then(dataa => {for(let i = ii; (i<ff && i<dataa.length); i++) {
        let data = dataa[i];
        pgs = Math.ceil(dataa.length/inpg);
        const user_photo = document.createElement('div');
        user_photo.className = 'user-photo';
        
        if(data.image){
            user_photo.innerHTML = `<img class="personal-img-sml" src="${data.image}" width="34px" height="34px">`;
        }else{
            user_photo.innerHTML = `<img class="personal-img-sml" src="storage/images/personal.png" width="34px" height="34px">`;
        }

        const user_id = document.createElement('div');
        user_id.className = 'user-id';
        user_id.innerText = data.id;
        const user_name = document.createElement('div');
        user_name.className = 'user-name';
        user_name.innerText = data.name;
        const user_position = document.createElement('div');
        user_position.className = 'user-position';
        user_position.innerText = data.position;
        const user_number = document.createElement('div');
        user_number.className = 'user-number';
        user_number.innerText = data.number;

        const det_btn = document.createElement('button');
        det_btn.className = 'edt-btn btn-ylo';
        det_btn.innerText = 'Details'
        /*const rmv_btn = document.createElement('button');
        rmv_btn.className = 'rmv-btn';
        rmv_btn.innerText = 'Remove'*/

        const user_row_texts = document.createElement('div');
        user_row_texts.className = 'user-row-texts';
        user_row_texts.append(user_photo);
        user_row_texts.append(user_id);
        user_row_texts.append(user_name);
        user_row_texts.append(user_position);
        user_row_texts.append(user_number);

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
                            <p><b>ID</b></p>
                            <input type="text" class="popup-field" id="add-user-id">
                        </div>
                        <div class="popup-content-div">
                            <p><b>Name</b></p>
                            <input type="text" class="popup-field" id="add-user-name">
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
                            <p><b>ID</b></p>
                            <div class="popup-field" id="add-user-id">${data.id}</div>
                        </div>
                        <div class="popup-content-div">
                            <p><b>Name</b></p>
                            <div class="popup-field" id="add-user-name">${data.name}</div>
                        </div>
                        <div class="popup-content-div">
                            <p><b>Position</b></p>
                            <div class="popup-field" id="add-user-position">${data.position}</div>
                        </div>
                        <div class="popup-content-div">
                            <p><b>Number</b></p>
                            <div class="popup-field" id="add-user-number">${data.number}</div>
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
                            <p><b>ID</b></p>
                            <div class="popup-field" id="add-user-id">${data.id}</div>
                            <!-- input type="text" id="add-user-id" value="${data.id}" -->
                        </div>
                        <div class="popup-content-div">
                            <p><b>Name</b></p>
                            <input class="popup-field" type="text" id="add-user-name"  value="${data.name}">
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
                            <input class="popup-field" type="text" id="add-user-number"  value="${data.number}">
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

        const confirm_button = document.querySelector('#confirm-button');
        edt_user(confirm_button, data.id);
        //confirm_button.addEventListener('click', event => {preview_user_window(data)})

        const delete_button = document.querySelector('#delete-button');
        delete_user(delete_button, data.id);
}

async function add_user(){

    const confirm_button = document.querySelector('#confirm-button');
    confirm_button.addEventListener('click', event => {handling()})

    const box = document.querySelector('.popup');
    box.addEventListener('keypress', e => {
        if(e.key == 'Enter')
        handling();
    });

    async function handling(){

        let my_id = document.querySelector('#add-user-id').value.toString();
        let my_name = document.querySelector('#add-user-name').value.toString();
        let my_pos = document.querySelector('#add-user-position').value.toString();
        let my_num = document.querySelector('#add-user-number').value.toString();
        let my_img = document.querySelector('#input_img').files['0'] ? await window.set_img() : '';

        $.ajax({
            type: "POST",
            url: `${url}`,
            data: JSON.stringify({
                "id" : my_id,
                "name" : my_name,
                "position" : my_pos,
                "number" : my_num,
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

async function edt_user(confirm_button,id){

    let my_id;
    let my_name;
    let my_pos;
    let my_num;
    let my_img;

    confirm_button.addEventListener('click', event => {handling()})

    const box = document.querySelector('.popup');
    box.addEventListener('keypress', e => {
        if(e.key == 'Enter')
        handling();
    });
    
    async function handling(){

        //my_id = document.querySelector('#add-user-id').value.toString();
        my_name = document.querySelector('#add-user-name').value.toString();
        my_pos = document.querySelector('#add-user-position').value.toString();
        my_num = document.querySelector('#add-user-number').value.toString();
        my_img = document.querySelector('#input_img').files[0];
        
        if(my_img){
            my_img = await window.set_img();
        }else{
            my_img = document.querySelector('#personal-img').src;
        }

        fetch(`${url}/${id}`, config())
        .then(function(res){ console.log(res) })
        .catch(function(res){ console.log(res) });

        users_render ();
        close_popup();
    }
}

function delete_user(del_btn, id){
    function config (){
        return {
            method: "Delete",
            headers: {
                "Content-Type": "application/json",
                //"Accept": "application.json"
            },
            mode: 'no-cors'
        };
    }

    
    del_btn.addEventListener('click', event => {
        event.preventDefault();

        /*fetch(`${url}?id=${id}`, config())
        .then(function(res){ console.log(res) })
        .catch(function(res){ console.log(res) });*/

        $.ajax({
            type: "DELETE",
            url: `${url}?id=${id}`})

        close_popup();
        users_render ();
    })
}

function close_popup(){
    const blur_genel = document.querySelector('#blur-genel');
    const genel = document.querySelector('#popup-genel');
    blur_genel.innerHTML = ``;
    genel.innerHTML = ``;
}

function doms(){
    users_render ();
    add_user_window();
    nxt_prvs();

}

/*document.querySelector('#signin-form').addEventListener('submit', event => {
    let username = document.querySelector('#username').value
    let password = document.querySelector('#password').value

    fetch(`http://myvh/api/admins_api.php?username=${username}&password=${password}`)
    .then(res => res.json())
    .then(dataa => {
        if(dataa){
            alert('gg')
        }
    })
})*/

function fileChange(){
    const file = document.querySelector('#input_img');
    const img = document.querySelector('#personal-img');

    img.src = URL.createObjectURL(file.files[0])
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

document.addEventListener('DOMContentLoaded',  doms)