$( document ).ready(function() {
   var save_btn = $('.btn-success.saveuser');

    var locations = {
        "Ukraine": ["Kyiv", "Kharkiv", "Dnipro", "Lviv"],
        "Poland":  ["Warsaw", "Krakow", "Lodz", "Poznan"],
        "Germany": ["Berlin", "Munich", "Köln", "Hamburg"]};

    var current_country = "Ukraine";

    $.each( locations, function( key ) {
        $("#set_country").append('<option>'+ key +'</option>');
    });

    function change_cities(country) {
        $("#set_city").empty();
        $.each( locations[country], function( key, value ) {
            $("#set_city").append('<option>'+ value +'</option>');
        });

    }
    change_cities(current_country);

    $( "#set_country" ).change(function() {
        current_country = $(this).val();
        change_cities(current_country);
    });


    // save_btn.on('click', function () {
    // });
});