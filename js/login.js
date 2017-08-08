$(document).ready(function() {
    $('#login').hide().fadeIn();
    $('#loading').addClass('test');
    $('#login :submit').click(function() {
        $(this).attr('disabled', 'disabled').addClass('disabled');
        return false;
    })
});