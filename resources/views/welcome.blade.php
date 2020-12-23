<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-success">
            <button id="list">danh sach</button>
        </div>
        <div class="card-body">
            <table class="table">
                <th>Stt</th>
                <th>First name</th>
                <th>Last name</th>
                <tbody id="result">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#list').click(function () {
            getAll()
        });
    });

    function getAll() {
        $.ajax({
            type: 'GET',
            url: '/api/customers',
            dataType: 'json',
            success: function (data) {
                display(data)
            }
        });
    }
    function display(data){
        let str='';
        for (let i=data.length-1;i>=0;i--){
            str+=`<tr>
                  <td>${data[i].id}</td>
                  <td>${data[i].first_name}</td>
                  <td>${data[i].last_name}</td>
                  <td><button onclick="remove(${this.id})">Delete</button></td>
                  </tr>`;
        }
        $('#result').html(str);
    }
    function remove(id){
        $.ajax({
            type: 'GET',
            url: '/api/customers',
            dataType: 'json',
            success: function (data) {
                console.log(data)
                data.splice(id,1);
                display(data)
            }
        });
    }
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
{{--        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"--}}
{{--        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"--}}
{{--        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"--}}
{{--        crossorigin="anonymous"></script>--}}
</body>
</html>
