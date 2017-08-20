$(document).ready(function() {
    // The input box verifies that the input data is useful information
    // 输入框验证,验证输入数据是有用信息
    // $('#register input').each(function() {
    //     $(this).blur(function() {
    //         var value = $(this).val();
    //         if(!value || value == " ") {
    //             $(this).addClass('test');
    //         }
    //         else
    //             $(this).removeClass('test');
    //         if ($(this).val() == ' ')
    //             alert($(this).val());
    //     });
    // });

    // After you click the registration button, submit the registration information after the validation data
    // 点击注册按钮后经过验证数据后提交注册信息

    // Binding validation function, when the following 2 cases occur, 1. click the submit button, and when the 2. focus moves out of the corresponding input box, check whether the content is entered as required. If no, display prompt information
    // 绑定验证功能，当出现以下２种情况时,1.点击提交按钮，2.焦点移出相应输入框时,检测是否按要求输入内容。如果否显示提示信息
    $('#register').validate({
        "youName" : {
            "rules" : new RegExp('/^[a-zA-Z]\w+/'),
        },
        "youPassword" : {
            "rules" : "test",
        }
    });
});


// validate 
$.fn.validate = function() {
    if (!Object.keys) {
        Object.keys = function (obj) {
            var keys = [],
                k;
            for (k in obj) {
                if (Object.prototype.hasOwnProperty.call(obj, k)) {
                    keys.push(k);
                }
            }
            return keys;
        };
    }

    var nodeTotal  = Object.keys(arguments[0]).length;
    if (!nodeTotal)
        return ;
    var result = arguments[0];
    for (var key in result) {
        $('[name=' + key + ']').on('blur', function() {
            // if verify not ok, return alert date
            alert('middle to be there');
            if (result[($(this).attr('name'))]["rules"].test($(this).val())) {
                alert('to thsi !');
            }
        });
    }
}