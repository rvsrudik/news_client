$( document ).ready(function() {
    var login_btn = $('.signin');
    var registr_btn = $('.signup');
    var email;
    var pass1;
    var pass2;


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function switch_to_login() {
        $('.alert, .btn.signup, .password2_block, .to_sign_in').hide();
        $('.to_sign_up, .btn.signin').fadeIn();

    }

    function switch_to_registration() {
        $('.alert, .btn.signin, .to_sign_up').hide();
        $('.btn.signup, .password2_block, .to_sign_in').fadeIn();

    }

    $('.to_sign_in').on('click', function () {
       switch_to_login();
    });

    $('.to_sign_up').on('click', function () {
       switch_to_registration();
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

    function get_inputs() {
        email = $('#auth_email').val();
        pass1 = $('#auth_pass1').val();
    }



    login_btn.on('click', function (e) {
        e.preventDefault();
        get_inputs();

        if (email === "" || pass1 === "") {
            display_error("Please, fill all fields.");
            return 0;
        }

        $.post( "login", { email: email, password: pass1 })
            .done(function( data ) {
                var server_answer = jQuery.parseJSON( data );

                if (server_answer.status === "fail") {
                    display_error(server_answer.description);
                } else  {
                    window.location.href = "/";

                    // display_succes(server_answer.description);
                }
            });

    });



    function validate_registration() {
        if (email === "" || pass1 === "" || pass2 === "") {
            display_error("Please, fill all fields.");
            return 0;
        }

        if (pass1 !== pass2) {
            display_error("Passwords are different.");
            return 0;
        }

        return 1;
    }


    registr_btn.on('click', function (e) {
        e.preventDefault();

        get_inputs();
        pass2 = $('#auth_pass2').val();

        if ( !validate_registration() ) {
            return;
        }

        $.post( "registration", { email: email, password: pass1 })
            .done(function( data ) {
                var server_answer = jQuery.parseJSON( data );

                if (server_answer.status === "fail") {
                    display_error(server_answer.description);
                } else  {
                    switch_to_login();
                    display_succes(server_answer.description);
                }
            });
    });



});