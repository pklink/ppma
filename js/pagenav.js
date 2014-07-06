$(function() {
    $('.page-nav select').change(function() {
        var self = $(this);
        var baseUrl = self.parent().attr('data-url');
        var url = baseUrl + '&pagesize=' + self.val();
        window.location.href = url;
    })
});