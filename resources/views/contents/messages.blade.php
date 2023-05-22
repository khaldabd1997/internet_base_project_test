<?php

if(!isset($_SESSION['loggedin'])){
    echo "Logged out";
    header("location:../login");
}else{
    $id = $_SESSION['id'];
?>


<div class="main-employees">
    <div class="users-menu">
        <div class="users-menu-header">
            <div class="users-menu-header-texts">
                <div class="message-sendername">Sender</div>
                <div class="message-subject">Subject</div>
            </div>
        </div>
        <div class="users-menu-body">
            <div id="users-menu-body">

            </div>
            <div class="users-menu-body-foter">
                <button class="btn btn-blu" id="prvs-btn" onclick="prvs()">&lt</button>
                <div id="page-num">1</div>
                <button class="btn btn-blu" id="nxt-btn" onclick="nxt()">&gt</button>
            </div>
        </div>
    </div>
    <div class="message-body">
        <div class="main-top-button">
            <!-- div style="margin-right: 1%;"><button class="btn btn-narrow btn-red">Delete</button></div -->
            <div><button onclick="new_message()" class="btn btn-blu" id="add-user">New Message</button></div>
        </div>
        <div id="message-body-sender" class="users-menu-row" style="border-top-width:0.5px;"><b>Sender : </b></div>
        <div id="message-body-subject" class="users-menu-row"><b>Subject : </b></div>
        <div id="message-body-date" class="users-menu-row"><b>Date : </b></div>
        <div id="message-body-text" class="users-menu-row" style="border-style:none;"></div>
    </div>
</div>

<script>
    const url = 'messages_api/';
    let id = '{{ $id }}';
    let ii = 0;
    let inpg = 10;
    let ff = inpg;
    let pg = 1;
    let pgs = 1;

    function get_messages() {
        const users_menu_body = document.querySelector('#users-menu-body');
        users_menu_body.innerHTML = "";

        fetch(`${url}/get.php?id=${id}`)
            .then(res => res.json())
            //.then(data => data.forEach(data => {
            .then(dataa => {
                for (let i = ii;
                    (i < ff && i < dataa.length); i++) {
                    let data = dataa[i];
                    pgs = Math.ceil(dataa.length / inpg);

                    const sender_name = document.createElement('div');
                    sender_name.className = 'message-sendername';
                    sender_name.innerText = data.sender_name;

                    const subject = document.createElement('div');
                    subject.className = 'message-subject';
                    subject.innerText = data.subject;

                    if (data.is_read == '0') {
                        subject.style.fontWeight = 'bold';
                        sender_name.style.fontWeight = 'bold';
                    }


                    const det_btn = document.createElement('button');
                    det_btn.className = 'edt-btn btn-ylo';
                    det_btn.innerText = 'Details'
                    /*const rmv_btn = document.createElement('button');
                    rmv_btn.className = 'rmv-btn';
                    rmv_btn.innerText = 'Remove'*/

                    const user_row_texts = document.createElement('div');
                    user_row_texts.className = 'user-row-texts';
                    user_row_texts.append(sender_name);
                    user_row_texts.append(subject);
                    //user_row_texts.append(user_email);

                    const user_row_buttons = document.createElement('div');
                    user_row_buttons.className = 'user-row-buttons';
                    user_row_buttons.append(det_btn);
                    //user_row_buttons.append(rmv_btn);

                    const users_menu_row = document.createElement('div');
                    users_menu_row.className = 'users-menu-row';
                    users_menu_row.append(user_row_texts);
                    //users_menu_row.append(user_row_buttons);

                    /*const users_menu_body = document.querySelector('#users-menu-body');
                    users_menu_body.innerHTML = ``*/
                    users_menu_body.prepend(users_menu_row);

                    const page_num = document.querySelector('#page-num');
                    page_num.innerHTML = `${pg} / ${pgs}`;

                    users_menu_row.addEventListener('click', event => {
                        preview_message(data)
                    })

                }
            });
    }

    function nxt() {
        if (pg < pgs) {
            ii = ii + inpg;
            ff = ff + inpg;
            pg++;
            get_messages();
            const page_num = document.querySelector('#page-num');
            page_num.innerHTML = `${pg} / ${pgs}`;
        }
    }

    function prvs() {
        if (pg != 1) {
            ii = ii - inpg;
            ff = ff - inpg;
            pg--;
            get_messages();
            const page_num = document.querySelector('#page-num');
            page_num.innerHTML = `${pg} / ${pgs}`;
        }
    }

    function preview_message(data) {
        document.querySelector('#message-body-sender').innerHTML = "<b>Sender :</b>&nbsp" + data.sender_name;
        document.querySelector('#message-body-subject').innerHTML = "<b>Subject :</b>&nbsp" + data.subject;
        document.querySelector('#message-body-date').innerHTML = "<b>Date :</b>&nbsp" + data.date + "   " + data.time;
        document.querySelector('#message-body-text').innerHTML = data.message;
        fetch(`${url}/read.php?id=${data.id}`);
        get_messages();
    }

    async function new_message() {
        const genel = document.querySelector('#popup-genel');
        genel.innerHTML = `
                <div class="popup my-border">
                    <div class="popup-header">
                        <div style="width: 95%"><b style="margin-left:5%">New Message</b></div>
                        <div style="width: 5%"><button id="close-button" onclick="close_popup()">X</button></div>
                    </div>
                    <div style="padding:5%">
                        <div style="display:flex; flex-flow:row; width:100%">
                            <div>
                                <p><b>To</b></p>
                                <select name="position" value="2" class="popup-field" id="message-to-list">
                                    
                                </select>
                            </div>
                            <div style="margin-left:10%">
                                <p><b>Subject</b></p>
                                <input type="text" class="popup-field" id="message-subject">
                            </div>
                        </div>
                        <div style="margin-top:4%">
                            <p><b>Message</b></p>
                            <textarea class="popup-field" id="message-text" style="width:100%; height:200px;"></textarea>
                        </div>
                        <div>
                            <submit class="btn btn-ylo" id="delete-button" onclick="send_message()">Send</button>
                        </div>
                    </div>
                </div>
                `;


                await elements();

        const blur_genel = document.querySelector('#blur-genel');
        blur_genel.innerHTML = `<div class="blur" onclick="close_popup()"></div>`;
    }

    async function elements() {
        await fetch(
            @if($_SESSION['type'] == 2)
            '/employees_api/get.php'
            @endif
            @if($_SESSION['type'] == 1)
            '/students_api/get.php'
            @endif
            )
            .then(res => res.json())
            .then(data => data.forEach(data => {
                let gg = document.createElement('option');
                gg.innerHTML = `${data.name} ${data.surname}`;
                gg.value = `${data.id}`
                document.querySelector('#message-to-list').append(gg);
            })
        )
    }

    function close_popup() {
        document.querySelector('#popup-genel').innerHTML = ``;
        document.querySelector('#blur-genel').innerHTML = ``;
    }

    function send_message() {
        let receiver = document.querySelector('#message-to-list').value.toString();
        let subject = document.querySelector('#message-subject').value.toString();
        let text = document.querySelector('#message-text').value.toString();
        var currentdate = new Date();
        let date = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
        let time = currentdate.getHours() + ":" + currentdate.getMinutes();

        $.ajax({
            type: "POST",
            url: `${url}/insert.php`,
            data: JSON.stringify({
                "receiver_id": receiver,
                "date": date,
                "time": time,
                "subject": subject,
                "message": text
            }),
            success: function(data) {
                close_popup();
            },
            error: function(resp, textStatus) {
                alert(resp.responseJSON.response);
            },
            processData: false
        });
    }

    get_messages();
</script>
<style>
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
        display: flex;
        flex-flow: row;
    }

    .users-menu {
        width: 30%;
        padding-right: 10px;
    }

    .message-body {
        width: 70%;
        border-left-style: solid;
        border-width: 0.5px;
        padding-left: 15px;
        padding-right: 15px;
        border-color: dimgrey;
    }

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
        width: 100%;
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

    .users-menu-row {
        border-width: 0px;
        height: 50px;
        border-bottom-width: 0.5px;
        border-style: solid;
        border-color: darkgray;
        display: flex;
        flex-flow: row;
        align-items: center;
        cursor: pointer;
    }

    .users-menu-row:hover {
        background-color: #D6DFE6;
    }

    .user-row-texts {
        width: 100%;
        display: flex;
        flex-flow: row;
        align-items: center;
        text-align: left;
        padding-left: 3%;
    }

    .message-sendername {
        width: 50%;
    }

    .message-subject {
        width: 50%;
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
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>

<?php } ?>
