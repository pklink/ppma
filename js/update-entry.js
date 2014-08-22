$(function() {

    $('.update-entry').live('click', function() {
        $('#entry-form-modal form').attr('action', $(this).attr('href'));

        $.ajax($(this).attr('rel')).done(function(response) {
            $.each(response, function(key, value) {
                $('#entry-form-modal #' + key).val(value);
            });
            $('.copy-to-clipboard').attr('data-clipboard-text', response.Entry_password);
        });

        return false
    });

});