$(function() {

    $('#upload-file').click(function() {
        $('#import-upload-form input[type=file]').click();
    })

    $('#import-upload-form input[type=file]').change(function() {
        $('#import-upload-form').submit();
    });

});