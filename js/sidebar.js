$(function() {
    if ($('aside').length > 0) {
        $('aside').sortable({
            handle: '.settings',
            update: function() {
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
    }
});