$( document ).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function display_error(msg) {
        $('.alert').hide();
        $('.alert-danger .description').html(msg);
        $('.alert-danger').fadeIn();
    }

    function display_succes(msg) {

        $('.alert').hide();
        $('.alert-success .description').html(msg);
        $('.alert-success').fadeIn();
    }

    var apiKey = '600b1a5d21a245d0ba6dc3e3a2c07120';
    var sources_tab = [];


    window.check_source = function show_news(elem) {

        var source_id = elem.attr('source_id');
        elem.toggleClass('btn-success');

        if ( elem.hasClass('btn-success') ) {
            sources_tab.push(source_id);
        } else {
            sources_tab = jQuery.grep(sources_tab, function(value) {
                return value != source_id;
            });
        }

    };

    $('.source-save-btn').on('click', function () {

        $.post( "/update_source", { sources: sources_tab })
            .done(function( data ) {
                if (data === "succes") {
                    display_succes("Source list was updated.");
                } else {
                    display_error("Unexpected error. Please, try again later.");

                }
            });
    });



    function get_sources() {
        $.post( "/get_sources")
            .done(function( data ) {
                if (data === "null") {
                    return;
                }

                var selected_list = jQuery.parseJSON( data );

                $.each( selected_list, function( key, value ) {
                        // console.log(value);
                    $("[source_id=" + value +"]").addClass('btn-success');

                });

                // sources = server_answer.join(',');

            });
    }


    function updatePage(data) {
        data.then(function(result) {

            var sources_tab = result['sources'];

            $.each( sources_tab, function( key, value ) {


                $('.source-block').append('' +

                    ' <div class="source-item source d-flex"  source_id="'+ value.id +'" onclick="check_source($(this))" >\n' +
                    '                    <div class="title">' + value.name+ '</div>\n' +
                    '                </div>'
                    );

            });
        });

    }




    function get_source_list() {
        var url = 'https://newsapi.org/v2/sources?' +
            '&apiKey=' + apiKey;

        var req = new Request(url);

        fetch(req).then(function(response) {
            updatePage(response.json());
            get_sources();
        })
    }

    get_source_list();



});