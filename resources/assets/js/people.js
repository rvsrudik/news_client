$( document ).ready(function() {

    $('.user-card').on('click', function () {

        $('.modal .modal-name').html($(this).attr('data-name'));
        $('.modal .modal-lastname').html($(this).attr('data-lastname'));
        $('.modal .modal-email').html($(this).attr('data-email'));
        $('.modal .modal-country').html($(this).attr('data-country'));
        $('.modal .modal-city').html($(this).attr('data-city'));
        $('.modal .modal-phone').html($(this).attr('data-phone'));
        $('.modal .modal-birthday').html($(this).attr('data-birthday'));
        $('.modal').find('.img').css('background-image', $(this).find('.img').css('background-image'));

    });

});