$(function() {

    $('.import-button-column a').click(function() {

        $(this).parent().parent().slideUp(function() {
            $(this).remove();
        });

    });

});