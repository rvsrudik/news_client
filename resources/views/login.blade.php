<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <script src="{{ mix('/js/app.js') }}"></script>


</head>
<body>

<div class="alert alert-success">
    <strong>Success!</strong> <span class="description"></span>
</div>


<div class="alert alert-danger">
    <strong>Error!</strong> <span class="description"></span>
</div>


<div class="container">
    <div class="row h-100 d-flex justify-content-center align-items-center">

        <div class="login-block" >
            <h1>News client</h1>

                <div class="form-group email_block">
                    <label for="auth_email">Email address *</label>
                    <input type="email" class="form-control" id="auth_email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group password1_block">
                    <label for="auth_pass1">Password *</label>
                    <input type="password" class="form-control" id="auth_pass1" placeholder="Password">
                </div>

                <div class="form-group password2_block">
                    <label for="auth_pass2">Password confirmation *</label>
                    <input type="password" class="form-control" id="auth_pass2" placeholder="Password confirmation">
                </div>

                <div class="btn-block d-flex justify-content-between">
                    <button type="submit" class="btn btn-default to_sign_up">New account</button>
                    <button type="submit" class="btn btn-default to_sign_in">Log in</button>
                    <button type="submit" class="btn btn-success signin">Sign In</button>
                    <button type="submit" class="btn btn-success signup">Sign Up</button>
                </div>
        </div>

    </div>
</div>

</body>
</html>