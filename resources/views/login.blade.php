<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

</head>
<body>


<div class="container">
    <div class="row h-100 d-flex justify-content-center align-items-center">

        <div class="login-block" >
            <h1>News client</h1>

            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="btn-block d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Sign In</button><button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
            </form>
        </div>


    </div>
</div>

</body>
</html>