(function($) {
  $(function() {
    var client = new ZeroClipboard($('.copy-to-clipboard'), {
      moviePath: './js/ZeroClipboard.swf'
    });
  });
})(jQuery);