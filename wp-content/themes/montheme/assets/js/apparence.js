(function ($) {

    wp.customize('montheme_second_header_background', function (value) {
        value.bind(function (newVal) {
            // $('.app-header_button-section').css('background', newVal);
            $('.app-header_button-section').attr('style', 'background:' + newVal);

        });

    });
    wp.customize('header_background', function (value) {
        value.bind(function (newVal) {
            $('.app-header_nav').css('background', newVal);
        });
    });

    // Ajout de l'écouteur d'événements pour la personnalisation du logo
    wp.customize('montheme_logo_nav', function (value) {
        value.bind(function (newLogo) {
            // Modifier l'attribut src de l'image du logo dans l'aperçu
            $('#app-header_logo img').attr('src', newLogo);
        });
    });


    wp.customize('montheme_footer_background', function (value) {
        value.bind(function (newVal) {
            $('.footer').css('background', newVal);
        });
    });


})(jQuery);


