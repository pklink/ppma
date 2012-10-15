$('#fancybox-content form').live('submit', function() {

	// create post data
	var data = $(this).serialize() + '&' + $(this).find(':submit').attr('name') + '=';
	
	// send form via ajax
	$.post($(this).attr('action'), data, function() {
		// close fancybox
		$.fancybox.close();
		
		// update grid is exist
		if ($.fn.yiiGridView) {
			$('.grid-view').each(function() {
				$.fn.yiiGridView.update( $(this).attr('id') );
			});
		}
	});
	
	return false;
});