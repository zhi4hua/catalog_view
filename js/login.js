$(document).ready(function() {
    $('#login').hide().fadeIn().children('form').validate({
        debug : false,
        dataType: 'json',
        submitHandler : function(form) {
            // detach loading
            var loadingNode = $('#loading').detach();
            $('#login').append(loadingNode).children("#loading").removeClass('template').automaticVerticalCentering();
            $(form).ajaxSubmit({
                // clearForm: true,
                success: function(data) {
                    data = JSON.parse(data);
                    var error = false;

                    if (data.type == 'success') {
                        $.cookie('userName', data['userName']);
                        // clearn the from controlled by this validator
                        // 清空输入内容
                        $(form).clearForm();
                        window.location.href = data.link;
                    } else 
                        warningWindow(data['type'], data['text']);
                        
                    $('#loading').addClass('template');
                },
                error: function(XmlHttpRequest, textStatus, errorThrown) {
                    var textTotal;

                    for (var text in errorThrown)
                        textTotal += ' ; ' + text;
                    alert('data = ' + textStatus + ' error throw = ' + errorThrown + ' XmlHttpRequest = ' + textTotal);
                },
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
                minlength: 6,
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