<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/sources.js') }}"></script>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">


    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>


<div class="alert alert-success position-relative">
    <strong>Success!</strong> <span class="description"></span>
</div>


<div class="alert alert-danger position-relative">
    <strong>Error!</strong> <span class="description"></span>
</div>


@include('includes.nav')



<div class="flex-center position-ref full-height">

    <div class="container">
        <div class="row">

            <button type="button" class="btn btn-success source-save-btn">Save</button>


            <div class="source-block col-sm-12 col-md-12 col-lg-12">
            </div>

        </div>
    </div>


</div>
</body>
</html>
