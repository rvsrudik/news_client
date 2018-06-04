$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var news_tab = [];
    var apiKey = '600b1a5d21a245d0ba6dc3e3a2c07120';
    var sources = '';
    var news_page = 1;
    var current_reading_news = 0;
    var news_counter = -1;


    function get_sources() {
        $.post( "/get_sources")
            .done(function( data ) {
                if (data === "null") {
                    $('.news-block').append("<h4 class='text-center'>Please, select at least one <a href='/sources'>source</a>.</h4>")
                    return;
                }
                var server_answer = jQuery.parseJSON( data );

                    sources = server_answer.join(',');

                get_news();
            });
    }


    $(window).scroll(function () {
        var w_scroll = $(window).scrollTop();
        var w_h = $(window).height();
        var doc_h = $(document).height();

        if ( (w_scroll + w_h) == doc_h ) {
            news_page++;
            get_news();
        }
    });

    window.detail_news = function show_news(nbr) {
        current_reading_news = nbr;

        $('.modal-title').html(news_tab[nbr].title);

        $('.modal-body .img').css('background-image', 'url(' + news_tab[nbr].urlToImage + ')' );
        $('.modal-body .description').html(news_tab[nbr].description);
        $('.modal .source-link').attr('href', news_tab[nbr].url);
    };



    $('.next-news').on('click', function () {
        if (current_reading_news < news_counter) {
            detail_news(current_reading_news + 1);
        }
    });

    $('.prev-news').on('click', function () {
        if (current_reading_news > 0) {
            detail_news(current_reading_news - 1);
        }
    });


    function updatePage(data) {


        data.then(function(result) {
            // news_tab.push(result['articles']);
            // console.log(news_tab);
            // console.log(result['articles']);


            $.each( result['articles'], function( key, value ) {
                // console.log(value);
                news_tab.push(value);
                news_counter++;

                $('.news-block').append(' <div onclick="detail_news(' + news_counter +')" news_n="' + news_counter+ '" data-toggle="modal" type=""   data-target="#myModal" class="news-item card d-flex">\n' +
                    // '                                    <div class="img" style="background-image: url(' + value.urlToImage + ')">\n' +
                    // '                                    </div>\n' +
                    '\n' +
                    '                                    <div class="news-info">\n' +
                    '                                        <div class="title">' + value.title + '</div>\n' +
                    // '                                        <div class="description">' + value.description + '</div>\n' +
                    '\n' +
                    '                                        <div class="add-info">\n' +
                    // '                                            <div class="news-source">' + value.source['name'] + '</div>\n' +
                    // '                                            <div class="publication">' + value.publishedAt + '</div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                            </div>');

            });
        });
    }



    function get_news() {
        var url = 'https://newsapi.org/v2/top-headlines?' +
            'sources=' + sources +
            '&page=' + news_page +
            '&apiKey=' + apiKey;

        var req = new Request(url);

        fetch(req).then(function(response) {
            updatePage(response.json());
        })
    }

    get_sources();



});