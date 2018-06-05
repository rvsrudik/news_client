<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script src="{{ mix('/js/app.js') }}"></script>
    {{--<script src="{{ mix('/js/news.js') }}"></script>--}}



    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">


    <title>Laravel</title>

    <style>
        .booth {
            align-items: center;
            width: 100%;
            display: flex;
            justify-content: space-around;
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .booth-capture-button {
            display: block;
            margin: 10px 0;
            padding: 10px 20px;
            background-color: cornflowerblue;
            color: #fff;
            text-align: center;
            text-decoration: none;
            width: 100%;
        }


        .booth-capture-button:hover {
            text-decoration: none;
            color: #fff;

        }

        .alert {
            display: none;
            position: relative;
            width: 100%;
        }

        #video {
            display: none;
        }
        #canvas {
            display: none;
        }
        #photo {
            height: 250px;
            width: 300px;
            background-position: 50% 50%;
            background-image: url("data:image/png;base64,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  ");
            background-repeat: no-repeat;
        }
        .profile-save-btn {
            margin: 0 auto;
            margin-bottom: 15px;
        }

        #capture {
            display: none;
        }
        .user-avatar-block {
            width: 300px;
        }


        @media screen and (max-width: 925px) {

            .booth {
                flex-direction: column;
            }
        }


    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#falseinput').attr('src', e.target.result);
                    $('#photo').css('background-image', 'url(' +  e.target.result + ')');
                    $('#photo').attr('data-image', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>


<body>


<div class="alert alert-success">
    <strong>Success!</strong> <span class="description"></span>
</div>


<div class="alert alert-danger">
    <strong>Error!<br></strong> <span class="description"></span>
</div>

@include('includes.nav')












<div class="flex-center position-ref full-height">

    <div class="container-fluid">
        <div class="row">



            <div class="container col-sm-11">
                <button type="button" class="col-sm-12  btn btn-success profile-save-btn">Save</button>

                <h5>1. User photo.</h5>
                <div>Take photo by web-cam or upload image. </div>

                <div class="booth">


                    <div class="user-avatar-block">
                        <div id="photo"  @if ($pic !== NULL) style="background-image: url( {{ $pic}} )" data-image="{{ $pic }}" @endif  ></div>
                        <input id="fileinput" type="file" class="booth-capture-button" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);"/>
                    </div>

                    <div>
                        <video id="video" width="300" height="250"></video>
                        <a href="#" id="enable-cam" class="booth-capture-button">Enable camera</a>
                        <a href="#" id="capture" class="booth-capture-button">Take photo</a>
                        <canvas id="canvas" width="300" height="250"></canvas>
                    </div>
                </div>

                <div class="form-group email_block">
                    <label for="profile_email">Email address *</label>
                    <input value="{{ $email }}" type="email" class="form-control" id="profile_email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="row">
                    <div class="form-group password1_block col-sm-12 col-md-6">
                        <label for="profile_pass1">New Password</label>
                        <input type="password" class="form-control" id="profile_pass1" placeholder="Fill to change password">
                    </div>

                    <div class="form-group password2_block  col-sm-12 col-md-6">
                        <label for="profile_pass2">New password confirmation</label>
                        <input type="password" class="form-control" id="profile_pass2" placeholder="Fill to change password">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group name_block col-sm-12 col-md-6">
                        <label for="user_name">Name *</label>
                        <input value="{{ $name }}" type="text"  class="form-control" id="profile_name" name="profile_name" required="required"  placeholder="Enter name"  pattern="[A-Za-z]{3,10}" title="Use only alphabet letters. 3-10 symbols.">
                    </div>


                    <div class="form-group last_name_block col-sm-12 col-md-6">
                        <label for="profile_last_name">Last name *</label>
                        <input value="{{ $lastname }}" type="text" class="form-control" id="profile_last_name" name="profile_last_name" required="required"  placeholder="Enter last name" pattern="[A-Za-z]{3,10}" title="Use only alphabet letters. 3-10 symbols.">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group country_block col-sm-12 col-md-6">
                        <label  for="set_country">Country:</label>
                        <select selected="{{ $country }}" data-selected="{{ $country }}" class="form-control" name="user_country" id="set_country"></select>
                    </div>

                    <div class="form-group city_block col-sm-12 col-md-6">
                        <label for="profile_city">City:</label>
                        <select selected="{{ $city }}" data-selected="{{ $city }}" class="form-control" name="profile_city" id="set_city"></select>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group phone_block col-sm-12 col-md-6">
                        <label for="profile_phone">Phone *</label>
                        <input value="{{ $phone }}" type="text" class="form-control" id="profile_phone" name="profile_phone" required="required" placeholder="Phone number" pattern="[0-9\+\-()]{3,20}" title="Only '0-9', '+ - ( )'. 3-20 max symbols.">
                    </div>

                    <div class="form-group birthday_block col-sm-12 col-md-6">
                        <label for="profile_birthday">Birthday *</label>
                        <input value="{{ $birthday }}" type="date" class="form-control" id="profile_birthday" name="profile_birthday" required="required"  placeholder="Birthday date" min="1955-01-02" max="2018-01-01">
                    </div>
                </div>

                <button type="button" class="col-sm-12  btn btn-success profile-save-btn">Save</button>

            </div>


        </div>

        </div>
    </div>

</div>


</body>
<script src="{{ mix('/js/photo.js') }}"></script>




</html>
