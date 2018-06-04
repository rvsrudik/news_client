$( document ).ready(function() {
   var save_btn = $('.btn-success.saveuser');
   var input_country = $('#set_country');
   var input_city = $('#set_city');
   var set_flag = 0;

    var locations = {
        "Ukraine": ["Kyiv", "Kharkiv", "Dnipro", "Lviv"],
        "Poland":  ["Warsaw", "Krakow", "Lodz", "Poznan"],
        "Germany": ["Berlin", "Munich", "Köln", "Hamburg"]};

    var current_country = "Ukraine";

    $.each( locations, function( key ) {
        $("#set_country").append('<option>'+ key +'</option>');
    });

    if (input_country.attr('data-selected') !== "") {
        current_country = input_country.attr('data-selected');
        input_country.val(current_country);
    }



    function change_cities(country) {
        input_city.empty();
        $.each( locations[country], function( key, value ) {
            input_city.append('<option>'+ value +'</option>');
        });

        if ( (input_city.attr('data-selected') !== "" ) && !set_flag) {
            var user_city = input_city.attr('data-selected');
            input_city.val(user_city);
            set_flag = 1;
        }

    }
    change_cities(current_country);


    input_country.change(function() {
        current_country = $(this).val();
        change_cities(current_country);
    });


});