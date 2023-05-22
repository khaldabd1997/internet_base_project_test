<div id="change-pass">
    Current Password<input id="old" type="password">
    New Password<input id="new" type="password">
    <button id="change" class="submit">Change Password</button>
</div>

<script>
    let url;
    if ('{{ $_SESSION['type'] }}' == '1') {
        url = "employees_api/password.php";
    }
    if ('{{ $_SESSION['type'] }}' == '2') {
        url = "students_api/password.php";
    }

    document.querySelector('#change').addEventListener('click', event => {
        var settings = {
            "url": `${url}`,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json"
            },
            "data": JSON.stringify({
                "old": document.querySelector('#old').value,
                "new": document.querySelector('#new').value
            }),
            success: function(data) {
                
            },
            error: function(resp, textStatus) {
                
            },
        };

        $.ajax(settings).done(function(response) {
            console.log(response);
        });
    })
</script>

<style>
    #change-pass {
        padding: 2%;
        width: 300px;
        display: flex;
        flex-flow: column;
    }

    input {
        border-radius: 7px;
        border-width: 0.5px;
        border-style: solid;
        border-color: darkgray;
        margin-bottom: 10px;
    }

    button {
        border-radius: 7px;
        border-style: none;
        padding: 3%;
        color: white;
        background-color: #F9CD6A;
    }

    button:hover {
        background-color: #FAB000;
    }
</style>
