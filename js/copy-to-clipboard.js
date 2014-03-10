(function($) {
  $(function() {
    var client = new ZeroClipboard($('.copy-to-clipboard'), {
      moviePath: './js/zeroclipboard/ZeroClipboard.swf'
    });
  });
})(jQuery);