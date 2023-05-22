<div class="main-top-button">
    <!-- div style="margin-right: 1%;"><button class="btn btn-narrow btn-red">Delete</button></div -->
    <div><button class="btn btn-blu" id="add-user">Add Activity</button></div>
</div>
<div class="main-employees">
    <div class="users-menu">
        <div class="users-menu-header">
            <div class="users-menu-header-texts">
                <div class="actv-name">Name</div>
                <div class="actv-date">Date</div>
                <div class="actv-time">Time</div>
                <div class="actv-dur">Duration</div>
                <div class="actv-lec">Lecturer</div>
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

<script>
    let ii = 0;
    let inpg = 10;
    let ff = inpg;
    let pg = 1;
    let pgs = 1;

    let url = '/activities_api';

    function users_render() {

        const users_menu_body = document.querySelector('#users-menu-body');
        users_menu_body.innerHTML = "";

        fetch(`${url}/get.php`)
            .then(res => res.json())
            //.then(data => data.forEach(data => {
            .then(dataa => {
                for (let i = ii;
                    (i < ff && i < dataa.length); i++) {
                    let data = dataa[i];
                    pgs = Math.ceil(dataa.length / inpg);

                    const actv_name = document.createElement('div');
                    actv_name.className = 'actv-name';
                    actv_name.innerText = data.name;
                    const actv_date = document.createElement('div');
                    actv_date.className = 'actv-date';
                    actv_date.innerText = data.date;
                    const actv_time = document.createElement('div');
                    actv_time.className = 'actv-time';
                    actv_time.innerText = data.time;
                    const actv_dur = document.createElement('div');
                    actv_dur.className = 'actv-dur';
                    actv_dur.innerText = data.duration;
                    const actv_lec = document.createElement('div');
                    actv_lec.className = 'actv-lec';
                    actv_lec.innerText = data.lecturer;

                    const det_btn = document.createElement('button');
                    det_btn.className = 'edt-btn btn-ylo';
                    det_btn.innerText = 'Details';

                    const user_row_texts = document.createElement('div');
                    user_row_texts.className = 'user-row-texts';
                    user_row_texts.append(actv_name);
                    user_row_texts.append(actv_date);
                    user_row_texts.append(actv_time);
                    user_row_texts.append(actv_dur);
                    user_row_texts.append(actv_lec);

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

                    det_btn.addEventListener('click', event => {
                        preview_user_window(data)
                    })

                }
            });
    }

    function nxt_prvs() {
        const page_num = document.querySelector('#page-num');

        const nxt_btn = document.querySelector('#nxt-btn');
        nxt_btn.addEventListener('click', event => {
            if (pg < pgs) {
                ii = ii + inpg;
                ff = ff + inpg;
                pg++;
                users_render();
                page_num.innerHTML = `${pg} / ${pgs}`;
            }
        })

        const prvs_btn = document.querySelector('#prvs-btn');
        prvs_btn.addEventListener('click', event => {
            if (pg != 1) {
                ii = ii - inpg;
                ff = ff - inpg;
                pg--;
                users_render();
                page_num.innerHTML = `${pg} / ${pgs}`;
            }
        })
    }

    //-------------------------------------- pop windows ----------------------------------------------

    function add_activity_window() {
        const add_activity = document.querySelector('#add-user')

        add_activity.addEventListener('click', event => {

            const genel = document.querySelector('#popup-genel');
            genel.innerHTML = `
<div class="popup my-border">
        <div class="popup-header">
            <div style="width: 95%"><b style="margin-left:5%">Add New Activity</b></div>
            <div style="width: 5%"><button id="close-button">X</button></div>
        </div class="popup-content-col1">
        <div class="popup-content">
            <div>
                <div class="popup-content-div" style="margin-top: 0px">
                    <p><b>Activity Name</b></p>
                    <input type="text" class="popup-field" id="add-actv-name">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Date</b></p>
                    <input type="date" class="popup-field" id="add-actv-date">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Time</b></p>
                    <input type="time" class="popup-field" id="add-actv-time">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Duration</b></p>
                    <input type="text" class="popup-field" id="add-actv-dur">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Lecture</b></p>
                    <input type="text" class="popup-field" id="add-actv-lec">
                </div>
            </div>
            <div class="popup-content-col2">
                <div class="popup-content-div">
                    <button class="btn btn-blu" id="confirm-button">Add</button>
                </div>
                <div class="popup-content-div" id="error-field">
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

            window.add_activity();
        })
    }

    function preview_user_window(data) {
        const genel = document.querySelector('#popup-genel');
        genel.innerHTML = `
<div class="popup my-border">
        <div class="popup-header">
            <div style="width: 95%"><b style="margin-left:5%">Activity</b></div>
            <div style="width: 5%"><button id="close-button">X</button></div>
        </div class="popup-content-col1">
        <div class="popup-content">
            <div>
                <div class="popup-content-div" style="margin-top: 0px">
                    <p><b>Activity Name</b></p>
                    <div type="text" class="popup-field" id="add-actv-name">${data.name}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Date</b></p>
                    <div type="text" class="popup-field" id="add-actv-date">${data.date}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Time</b></p>
                    <div type="text" class="popup-field" id="add-actv-time">${data.time}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Duration</b></p>
                    <div type="text" class="popup-field" id="add-actv-dur">${data.duration}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Lecture</b></p>
                    <div type="text" class="popup-field" id="add-actv-lec">${data.lecturer}</div>
                </div>
            </div>
            <div class="popup-content-col2">
                <div class="popup-content-div">
                    <button class="btn btn-blu" id="edit-button">Edit</button>
                </div>
                <div class="popup-content-div" id="error-field">
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
        edt_btn.addEventListener('click', event => {
            edit_user_window(data)
        })
    }

    function edit_user_window(data) {
        const genel = document.querySelector('#popup-genel');
        genel.innerHTML = `
<div class="popup my-border">
        <div class="popup-header">
            <div style="width: 95%"><b style="margin-left:5%">Edit Activity</b></div>
            <div style="width: 5%"><button id="close-button">X</button></div>
        </div class="popup-content-col1">
        <div class="popup-content">
            <div>
                <div class="popup-content-div" style="margin-top: 0px">
                    <p><b>Activity Name</b></p>
                    <input type="text" class="popup-field" id="add-actv-name" value="${data.name}">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Date</b></p>
                    <input type="text" class="popup-field" id="add-actv-date" value="${data.date}">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Time</b></p>
                    <input type="text" class="popup-field" id="add-actv-time" value="${data.time}">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Duration</b></p>
                    <input type="text" class="popup-field" id="add-actv-dur" value="${data.duration}">
                </div>
                <div class="popup-content-div">
                    <p><b>Activity Lecture</b></p>
                    <input type="text" class="popup-field" id="add-actv-lec" value="${data.lecturer}">
                </div>
            </div>
            <div class="popup-content-col2">
                <div class="popup-content-div">
                    <button class="btn btn-blu" id="confirm-button">Confirm</button>
                </div>
                <div class="popup-content-div">
                    <button class="btn btn-narrow btn-red" id="delete-button">Delete</button>
                </div>
                <div class="popup-content-div" id="error-field">
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

        edt_activity(data.id);
        delete_activity(data.id);
    }

    //-------------------------------------- CRUD ----------------------------------------------

    async function add_activity() {

        const confirm_button = document.querySelector('#confirm-button');
        confirm_button.addEventListener('click', event => {
            handling()
        })

        const box = document.querySelector('.popup');
        box.addEventListener('keypress', e => {
            if (e.key == 'Enter')
                handling();
        });

        async function handling() {

            let my_name = document.querySelector('#add-actv-name').value.toString();
            let my_date = document.querySelector('#add-actv-date').value.toString();
            let my_time = document.querySelector('#add-actv-time').value.toString();
            let my_dur = document.querySelector('#add-actv-dur').value.toString();
            let my_lec = document.querySelector('#add-actv-lec').value.toString();

            $.ajax({
                type: "POST",
                url: `${url}/insert.php`,
                data: JSON.stringify({
                    "name": my_name,
                    "date": my_date,
                    "time": my_time,
                    "duration": my_dur,
                    "lecturer" : my_lec
                }),
                success: function(data) {
                    //console.log(data);
                    users_render();
                    close_popup();
                },
                error: function(resp, textStatus) {
                    //alert(resp.responseJSON.response);
                    document.querySelector('#error-field').innerHTML = resp.responseJSON.response;
                },
                processData: false
            });
        }
    }

    async function edt_activity(id) {

        const confirm_button = document.querySelector('#confirm-button');
        confirm_button.addEventListener('click', event => {
            handling()
        })

        const box = document.querySelector('.popup');
        box.addEventListener('keypress', e => {
            if (e.key == 'Enter')
                handling();
        });

        async function handling() {

            let my_name = document.querySelector('#add-actv-name').value.toString();
            let my_date = document.querySelector('#add-actv-date').value.toString();
            let my_time = document.querySelector('#add-actv-time').value.toString();
            let my_dur = document.querySelector('#add-actv-dur').value.toString();
            let my_lec = document.querySelector('#add-actv-lec').value.toString();

            $.ajax({
                type: "POST",
                url: `${url}/edit.php`,
                data: JSON.stringify({
                    "id": id,
                    "name": my_name,
                    "date": my_date,
                    "time": my_time,
                    "duration": my_dur,
                    "lecturer" : my_lec
                }),
                success: function(data) {
                    //console.log(data);
                    users_render();
                    close_popup();
                },
                error: function(resp, textStatus) {
                    //alert(resp.responseJSON.response);
                    document.querySelector('#error-field').innerHTML = resp.responseJSON.response;
                },
                processData: false
            });
        }
    }

    function delete_activity(id) {

        const del_btn = document.querySelector('#delete-button');
        del_btn.addEventListener('click', event => {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: `${url}/delete.php`,
                data: JSON.stringify({
                    "id": id
                }),
                success: function(data) {
                    //console.log(data);
                    users_render();
                    close_popup();
                },
                error: function(resp, textStatus) {
                    alert(resp.responseJSON.response);
                },
                processData: false
            });

            close_popup();
            users_render();
        })
    }

    //-------------------------------------- image ----------------------------------------------

    function fileChange() {
        const file = document.querySelector('#input_img');
        const img = document.querySelector('#personal-img');

        img.src = URL.createObjectURL(file.files[0]);
    }

    async function set_img() {
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

        await $.ajax(settings).done(function(response) {
            let jx = JSON.parse(response);
            //console.log(jx.data.url);
            img_path = jx.data.url;
        });

        return `${img_path}`;
    }

    //-------------------------------------- functions ----------------------------------------------

    function close_popup() {
        const blur_genel = document.querySelector('#blur-genel');
        const genel = document.querySelector('#popup-genel');
        blur_genel.innerHTML = ``;
        genel.innerHTML = ``;
    }

    //------------------------------------------------------------------------------------------------

    function doms() {
        users_render();
        add_activity_window();
        nxt_prvs();
    }

    users_render();
    add_activity_window();
    nxt_prvs();

    //document.addEventListener('DOMContentLoaded',  doms)
</script>

<style>
    .users-menu-header {
        background-color: #ffffff;
        /*border-top-left-radius: 10px;
    border-top-right-radius: 10px;*/
        border-style: none;
        border-bottom-style: solid;
        font-weight: bold;
        border-width: 0.5px;
        border-color: dimgrey;
    }

    .users-menu-header-texts {
        height: 50px;
        width: 85%;
        display: flex;
        flex-flow: row;
        align-items: center;
        text-align: left;
        padding-left: 3%;
    }

    .users-menu-body {

        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .users-menu-body-foter {
        background-color: #ffffff;
        display: flex;
        flex-flow: row;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border-bottom-style: solid;
        border-color: dimgrey;
        border-width: 0.5px;
    }

    .users-menu-body-foter button {
        padding-left: 1%;
        padding-right: 1%;
        padding-top: 0.1%;
        padding-bottom: 0.1%;
        margin-left: 2%;
        margin-right: 2%;
    }

    .my-border {
        border-style: solid;
        border-width: 0.5px;
        border-color: darkgray;
    }

    .users-menu-row {
        border-width: 0px;
        border-bottom-width: 0.5px;
        border-style: solid;
        border-color: darkgray;
        display: flex;
        flex-flow: row;
        align-items: center;
    }

    .user-row-texts {
        width: 85%;
        height: 50px;
        display: flex;
        flex-flow: row;
        align-items: center;
        text-align: left;
        padding-left: 3%;
    }

    .actv-name {
        width: 15%;
    }

    .actv-date {
        width: 15%;
    }

    .actv-time {
        width: 15%;
    }

    .actv-dur {
        width: 15%;
    }

    .actv-lec {
        width: 15%;
    }

    .user-row-buttons {
        width: 15%;
        display: flex;
        flex-flow: row;
        align-items: center;
        justify-content: end;
        justify-self: end;
        padding-right: 5%;
    }

    .main-top-button {
        display: flex;
        flex-flow: row;
        justify-content: right;
        padding-right: 30px;
        padding-top: 15px;
        padding-bottom: 0px;
    }

    #error-field {
        color: #d12121;
        font-size: 0.75em;
    }
</style>
