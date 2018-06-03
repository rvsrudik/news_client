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


        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>


    @include('includes.nav')

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    <h4 class="modal-title">Modal Header</h4>
                </div>

                <div class="modal-body">
                    <div class="news-item card d-flex">
                    <div class="img" style="background-image: url(https://static.toiimg.com/photo/54474561.cms)">
                    </div>
                    <div class="news-info">
                    <div class="description"></div>

                    <div class="add-info">
                    <div class="news-source">BBS NEWS</div>
                    </div>
                    </div>
                    </div>
                </div>

                <div class="modal-footer">

                    <div class="top-buttons d-flex">
                        <button type="button" class="btn btn-info prev-news">Prev</button>
                        <a class="source-link" target="_blank" href=""><button type="button" class="btn btn-success">Read from source</button></a>
                        <button type="button" class="btn btn-info next-news">Next</button>
                    </div>

                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>







    <div class="flex-center position-ref full-height">

            <div class="container">
                <div class="row">

                        <div class="news-block col-sm-12 col-md-12 col-lg-12">
                        </div>

                </div>
            </div>


        </div>
    </body>
</html>
