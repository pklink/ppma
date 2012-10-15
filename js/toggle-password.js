$(function() {
	$('a.show-hide-password').live('click', function() {
		var original = $(this).parent().parent().find('input');
		var clone    = original.clone();
		
		if (original.attr('type') == 'text') {
			clone.attr('type', 'password');
		}
		else {
			clone.attr('type', 'text');
		}
		
		original.replaceWith(clone);
	});
});