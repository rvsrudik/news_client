$( document ).ready(function() {
    var save_btn = $('.profile-save-btn');

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


    save_btn.on('click', function () {

        $.post( "profile", {
            email:      $('#profile_email').val(),
            password1:  $('#profile_pass1').val(),
            password2:  $('#profile_pass2').val(),
            name:       $('#profile_name').val(),
            lastname:   $('#profile_last_name').val(),
            country:    $('#set_country').val(),
            city:       $('#set_city').val(),
            phone:      $('#profile_phone').val(),
            birth:      $('#profile_birthday').val(),
            pic:        $('#photo').attr('data-image')

        })
            .done(function( data ) {
                var server_answer = jQuery.parseJSON( data );

                // console.log(server_answer);
                console.log(data);
                if (server_answer.status === "fail") {
                    display_error(server_answer.description);
                } else  {
                    display_succes(server_answer.description);
                }
            });
    });

});