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
            <div class="popup-content-col1">
                <div class="popup-content-div">
                    <p><b>TC</b></p>
                    <div class="popup-field" id="add-user-tc">{{ $tc }}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Name</b></p>
                    <div class="popup-field" id="add-user-name">{{ $name }}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Surname</b></p>
                    <div class="popup-field" id="add-user-surname">{{ $surname }}</div>
                </div>
            </div>
            <div class="popup-content-col1">
                <div class="popup-content-div">
                    <p><b>Department</b></p>
                    <div class="popup-field" id="add-user-position">{{ $depatment }}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Number</b></p>
                    <div class="popup-field" id="add-user-number">{{ $mobile }}</div>
                </div>
                <div class="popup-content-div">
                    <p><b>Email</b></p>
                    <div class="popup-field" id="add-user-email">{{ $email }}</div>
                </div>
            </div>
            <div class="popup-content-col2">
                <div class="popup-content-div">
                    <img src={{ $image ? $image : 'storage/images/personal.png' }} class="my-border personal-img"
                        id="personal-img" width="200px" height="200px">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let url = '/employees_api';

    function edit_user_window() {
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
                    <!-- div class="popup-field" id="add-user-tc">{{ $tc }}</div -->
                    <input class="popup-field" type="text" id="add-user-tc" value="{{ $tc }}">
                </div>
                <div class="popup-content-div">
                    <p><b>Name</b></p>
                    <input class="popup-field" type="text" id="add-user-name"  value="{{ $name }}">
                </div>
                <div class="popup-content-div">
                    <p><b>Surname</b></p>
                    <input class="popup-field" type="text" id="add-user-surname"  value="{{ $surname }}">
                </div>
                <div class="popup-content-div">
                    <p><b>Department</b></p>
                    <input type="text" class="popup-field" id="add-user-position">
                </div>
                <div class="popup-content-div">
                    <p><b>Number</b></p>
                    <input class="popup-field" type="text" id="add-user-number"  value="{{ $mobile }}">
                </div>
                <div class="popup-content-div">
                    <p><b>Email</b></p>
                    <input class="popup-field" type="text" id="add-user-email"  value="{{ $email }}">
                </div>
                <div class="popup-content-div" id="error-field">
                </div>
            </div>
            <div class="popup-content-col2">
                <div class="popup-content-div">
                    <img src={{ $image ? $image : 'storage/images/personal.png' }} class="my-border personal-img" id="personal-img" width="200px" height="200px">
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

        edt_user('{{ $id }}');
    }

    const edt_btn = document.querySelector('#edit-button');
    edt_btn.addEventListener('click', event => {
        edit_user_window()
    })

    async function edt_user(id) {

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
                    "id": id,
                    "tc": my_tc,
                    "name": my_name,
                    "surname": my_surname,
                    "depatment": my_pos,
                    "mobile": my_num,
                    "email": my_email,
                    "image": my_img
                }),
                success: function(data) {
                    //console.log(data);
                    close_popup();
                },
                error: function(resp, textStatus) {
                    alert(resp.responseJSON.response);
                },
                processData: false
            });
        }
    }

    function close_popup() {
        const blur_genel = document.querySelector('#blur-genel');
        const genel = document.querySelector('#popup-genel');
        blur_genel.innerHTML = ``;
        genel.innerHTML = ``;
    }

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
</script>

<style>
    .main-top-button {
        display: flex;
        flex-flow: row;
        justify-content: right;
        padding-right: 30px;
        padding-top: 15px;
        padding-bottom: 0px;
    }
    .personal-img {
        border-radius: 100px;
    }

</style>