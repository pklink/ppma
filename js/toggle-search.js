$(function() {
	$('.search-form').hide();
	
	$('.search-button').click(function(){
		if ($('.search-form').is(':visible')) {
			$('.search-form').slideUp();
		}
		else {
			$('.search-form').slideDown();
		}
		
		return false;
	});
	
	$('.search-form form').submit(function(){
		var form = this;
		
		$('.grid-view').each(function() {
			$.fn.yiiGridView.update($(this).attr('id'), {
				data: $(form).serialize()
			});
		});
		
		return false;
	});
});