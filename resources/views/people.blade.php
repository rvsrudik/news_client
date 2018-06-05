<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/news.js') }}"></script>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">


    <title>People</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body id="people_page">


@include('includes.nav')


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="modal-name"></span> &nbsp;&nbsp;<span class="modal-lastname"></span></h4>
            </div>
            <div class="modal-body">

                <div class="top-block">
                    <div class="modal-photo">
                        <div class="img" style="background-image: url(https://static.toiimg.com/photo/54474561.cms)">
                    </div>
                    <div class="modale-right-info">

                        <div>Email:</div>
                        <div class="modal-email modal-info"></div>
                        <div>Phone:</div>
                        <div class="modal-phone modal-info"></div>
                        <div>Birthday date:</div>
                        <div class="modal-birthday modal-info"></div>
                        <div>Country:</div>
                        <div class="modal-country modal-info"></div>
                        <div>City:</div>
                        <div class="modal-city modal-info"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>





<div class="flex-center position-ref full-height">

    {{ $users->links() }}

    <div class="container">

        <div class="row">
        @foreach ($users as $user)

            <div  data-toggle="modal" data-target="#myModal" class="user-card" data-name="{{$user->name}}" data-lastname="{{$user->lastname}}"  data-lastname="{{$user->lastname}}" data-email="{{$user->email}}" data-country="{{$user->country}}" data-city="{{$user->city}}" data-phone="{{$user->phone}}" data-birthday="{{$user->birthday}}">
                <div class="img" @if ($user->pic !== NULL) style="background-image: url( {{ $user->pic}} )" @endif></div>
                <div class="name">{{ $user->name }}</div>

            </div>


        @endforeach
        </div>
    </div>

    {{ $users->links() }}


</div>
</body>
</html>
