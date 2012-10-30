$(function() {

    $('.update-entry').live('click', function() {
        $('#entry-form-modal form').attr('action', $(this).attr('href'));

        $.ajax($(this).attr('rel'), {
            'success': function(response) {
                $.each(response, function(key, value) {
                    $('#entry-form-modal #' + key).val(value);
                });
            }
        });

        return false
    });

});