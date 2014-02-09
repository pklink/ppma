$(function() {
    if ($('nav .search [name=q]').length > 0) {
        $('nav .search [name=q]').autocomplete({
            source:    $('nav .search [name=q]').first().attr('rel'),
            minLength: 3
        });
    }
});