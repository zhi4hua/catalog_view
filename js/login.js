$(document).ready(function() {
    $('#login').hide().fadeIn();
    $('#login :submit').click(function() {
        $(this).attr('disabled', 'disabled').addClass('disabled');

        // detach loading
        var loadingNode = $('#loading').detach();
        $('#login').append(loadingNode).children("#loading").removeClass('template').automaticVerticalCentering();

        return false;
    })
});

// Automatic vertical centering
// 自动竖直居中
$.fn.automaticVerticalCentering = function() {
    this.css({
        'height': this.height() + 'px',
        'line-height' : this.height() + 'px'
    });
}