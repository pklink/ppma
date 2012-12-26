$(function() {
    $('aside').sortable({
        handle: '.settings',
        update: function(event, ui) {
            var settings = {};

            $(this).find('.panel').each(function(index, element) {
                var id = $(element).attr('id').replace(/-/g, '_') + "_widget_position";
                /*settings.push({
                    'name': id,
                    'position': index
                });*/
                settings[id] = index;
            });

            $.ajax({
                url: $(this).attr('rel'),
                data: settings,
                type: 'POST'
            });
        }
    });
});