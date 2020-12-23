<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
        crossorigin="anonymous"></script>
<div class="container">
    <div class="card">
        <div class="card-header bg-success">
            Add customer
        </div>
        <div class="card-body">
            <form action="">
                <p>First Name: <input type="text" name="first_name" id="first_name" class="form-control"/> <span
                        id="first_name"></span></p>
                <p>Last Name: <input type="text" name="last_name" id="last_name" class="form-control"/> <span
                        id="last_name"></span></p>
                <button id="addCustomer">ADD</button>
            </form>

        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success">
            Edit customer
        </div>
        <div class="card-body">
            <input type="hidden" id="customer_id">
            <p>First Name: <input type="text" name="first_name" id="edit_first_name" class="form-control"/> <span
                    id="first_name"></span></p>
            <p>Last Name: <input type="text" name="last_name" id="edit_last_name" class="form-control"/> <span
                    id="last_name"></span></p>
            <button id="update" onclick="updateCustomer()">update</button>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-success">
            <button id="list">danh sach</button>
            <input type="search" id="searchByName" onkeyup="searchByFirstName()">
            <button id="search" class="btn btn-primary" onclick="searchByFirstName()">search</button>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Stt</th>
                    <th>First name</th>
                    <th>Last name</th>
                </tr>

                <tbody id="result">

                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="result"></div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#addCustomer').click(function () {

            addCustomer();
        });
        $('#list').click(function () {
            getAll();
        });
    });
    var addCustomer = function () {
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var customer = {first_name, last_name};

        $.ajax({
            type: 'POST',
            url: '/api/customers/',
            data: customer,
            success: function () {
                getAll();
            }
        });
        clear();

    }
    let getAll = function () {
        $.ajax({
            type: 'GET',
            url: '/api/customers',
            dataType: 'json',
            success: function (response) {
                console.log(response)
                display(response);

            }
        })
    }
    function searchByFirstName(){
        var key= $('#searchByName').val();
        $.ajax({
            type:'GET',
            url:'/api/customers/search/'+key,
            dataType:'json',
            success: function (data){
                display(data)
            }
        })

    }

    function deleteCustomer(id) {
        $.ajax({
            type: 'DELETE',
            url: '/api/customers/' + id,
            dataType: 'json',
            success: function () {
                getAll();

            }
        })
    }

    function getById(id) {
        $.ajax({
            type: 'GET',
            url: '/api/customers/' + id,
            dataType: 'json',
            success: function (data) {
                console.log(data)
                $('#edit_first_name').val(data['first_name']);
                $('#edit_last_name').val(data['last_name']);
                $('#customer_id').val(data['id']);
            }
        })
    }

    function updateCustomer() {
        var first_name = $('#edit_first_name').val();
        var last_name = $('#edit_last_name').val();
        var id=$('#customer_id').val();
        var customer = {first_name, last_name};

        $.ajax({
            type:'PUT',
            url:'/api/customers/'+id,
            data:customer,
            success: function (){
                getAll();
               $('#customer_id').val('');
               $('#edit_first_name').val('');
               $('#edit_last_name').val('');
            }
        })
    }

    function display(response) {
        let str = '';
        for (let i = response.length - 1; i >= 0; i--) {
            str += `<tr>
                    <td>${response[i].id}</td>
                    <td>${response[i].first_name}</td>
                    <td>${response[i].last_name}</td>
                    <td><button class="btn btn-danger" onclick="deleteCustomer(${response[i].id})" >delete</button></td>
                    <td><button class="btn btn-primary" onclick="getById(${response[i].id})" >Edit</button></td>
                    </tr>`

        }

        $('#result').html(str)
    }

    function clear() {
        $('#first_name').val('');
        $('#last_name').val('');
    }


</script>
