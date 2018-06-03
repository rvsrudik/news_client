<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <script src="{{ mix('/js/app.js') }}"></script>


</head>
<body id="set_account_page">

<div class="alert alert-success">
    <strong>Success!</strong> <span class="description"></span>
</div>


<div class="alert alert-danger">
    <strong>Error!</strong> <span class="description"></span>
</div>


<div class="container">
    <div class="row d-flex justify-content-center align-items-center">

        <form action="/set_account" method="post">
            {{ csrf_field() }}

        <div class="login-block" >
            <h1>Set your account info</h1>

            <div class="form-group name_block">
                <label for="set_name">Name *</label>
                <input type="text"  class="form-control" id="set_name" name="user_name" required="required"  placeholder="Enter name"  pattern="[A-Za-z]{3,10}" title="Use only alphabet letters. 3-10 symbols.">
            </div>

            <div class="form-group last_name_block">
                <label for="set_last_name">Last name *</label>
                <input type="text" class="form-control" id="set_last_name" name="user_lastname" required="required"  placeholder="Enter last name" pattern="[A-Za-z]{3,10}" title="Use only alphabet letters. 3-10 symbols.">
            </div>

            <div class="form-group country_block">
                <label for="set_country">Country:</label>
                <select class="form-control" name="user_country" id="set_country"></select>
            </div>

            <div class="form-group city_block">
                <label for="set_city">City:</label>
                <select class="form-control" name="user_city" id="set_city"></select>
            </div>


            <div class="form-group phone_block">
                <label for="set_phone">Phone *</label>
                <input type="text" class="form-control" id="set_phone" name="user_phone" required="required" placeholder="Phone number" pattern="[0-9\+\-()]{3,20}" title="Only '0-9', '+ - ( )'. 3-20 max symbols.">
            </div>

            <div class="form-group birthday_block">
                <label for="set_birthday">Birthday *</label>
                <input type="date" class="form-control" id="set_birthday" name="user_bith" required="required"  placeholder="Birthday date" min="1955-01-02" max="2018-01-01">
            </div>


            <div class="btn-block d-flex justify-content-between">
                <div  class="btn btn-danger signout"><a  href="{{ url('/logout') }}">Sign Out</a></div>
                <button type="submit" class="btn btn-success saveuser">Save</button>
            </div>
        </div>

        </form>

    </div>
</div>

</body>
</html>