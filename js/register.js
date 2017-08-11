$(document).ready(function() {
    $('#youName').blur(function() {
        if(!$(this).val())
            $(this).addClass('test');
    });
});

