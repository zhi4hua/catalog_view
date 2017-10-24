$(document).ready(function() {
    $('#login').hide().fadeIn().children('form').validate({
        debug : true,
        submitHandler : function(form) {
            // form.preventDefault();
            // detach loading
            var loadingNode = $('#loading').detach();
            $('#login').append(loadingNode).children("#loading").removeClass('template').automaticVerticalCentering();
            $.post($(form).attr('action'), ($(form).serialize()), function(data, state) {
                data = JSON.parse(data);
                if (state == 'success') {
                    if (data.type == 'success')
                        window.location.href = data.link;
                }
            });
        },
        onkeyup : false,
        rules :{
            youMail : {
                required: true,
                email   : true,
            },
            youPassword : {
                required: true,
            }
        },
    });
    // $('#login :submit').on('click', function(event) {
    //     event.preventDefault();
    //     // $(this).attr('disabled', 'disabled').addClass('disabled');
    //     // var contentText = $(this).parents('form').serialize();
    //     // warningWindow('Test', contentText);

    // });
});

// Automatic vertical centering
// 自动竖直居中
$.fn.automaticVerticalCentering = function() {
    this.css({
        'height': this.height() + 'px',
        'line-height' : this.height() + 'px'
    });
    return ;
}