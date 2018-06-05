<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="{{ mix('/js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">


    <title>{{ $name }} profile</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>

<body id="profile-page">


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
                        <input id="fileinput" type="file" class="booth-capture-button" accept="image/gif, image/jpeg, image/png"/>
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
