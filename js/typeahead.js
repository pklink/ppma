$(function() {

    $('nav .search [name=q]').autocomplete({
        source:    $('nav .search [name=q]').first().attr('rel'),
        minLength: 3
    });


});