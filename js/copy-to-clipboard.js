$(function() {
    new ZeroClipboard($('.copy-to-clipboard'));
    $("a.copy-to-clipboard").click(function(e){e.preventDefault();});
});