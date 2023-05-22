<div class="main-div">
    <div class="column" id="column">
    </div>
</div>

<style>
    .main-div {
        padding: 2%;
    }

    .column {
        width: 100%;
        padding: 2%;
        display: flex;
        flex-flow: row;
    }

    .box {
        width: 25%;
        padding: 3%;
        margin-right: 3%;
        border-radius: 7px;
        background-color: rgb(41, 109, 1);
        color: white;
    }

    .box p {}
</style>

<script>
    fetch(`/activities_api/get.php`)
        .then(res => res.json())
        .then(data => data.forEach(data => {
            if (Date.parse(data.date) - Date.now() >= 0) {
                const actv = document.createElement('div');
                actv.className = "box"
                actv.innerHTML = `
                <h4 style="margin-bottom: 10%"><b>${data.name}</b></h4>
                <p>${data.lecturer}</p>
                <p>${data.date}</p>
                <p>${data.time}</p>
                <p>${data.duration} minuts</p>
                `

                document.querySelector('#column').append(actv);
            }
        }))
</script>
