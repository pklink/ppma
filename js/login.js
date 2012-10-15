$(function() {

    $('a').click(function() {
       $('form').has(this).submit();
    });

    $('form input').keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $('form').has(this).submit();
        }
    });

});