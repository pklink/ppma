$(function() {

    $('.import-button-column i').click(function() {
        $(this).parent().parent().slideUp(function() {
            $(this).remove();
        });
    });

});