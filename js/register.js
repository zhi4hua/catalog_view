$(document).ready(function() {

    // Binding validation function, when the following 2 cases occur, 1. click the submit button, and when the 2. focus moves out of the corresponding input box, check whether the content is entered as required. If no, display prompt information
    // 绑定验证功能，当出现以下２种情况时,1.点击提交按钮，2.焦点移出相应输入框时,检测是否按要求输入内容。如果否显示提示信息
    $('#register').validate({
        // "youName" : {
        //     "rules" : "^[a-zA-Z]+\\w*$",
        //     "message" : "Input error, Please enter a similar 'zhihua'",
        // },
        // "youPhone" : {
        //     "rules" : "^\\d{11}$",
        //     "message" : "Input error, Please enter a eleven digit number",
        // },
        "youMail" : {
            "rules" : "^[a-zA-Z0-9]{2,11}@\\w+.[a-zA-Z0-9]{2,4}$",
            "message" : 'Input error, Please enter a similar "user@host.org"',
        },
        "youPassword" : {
            "rules" : "^.{6,23}$",
            "message" : 'Please enter a password with at least 6 bits and up to 23 characters',
        },
        "youConfirmPassword" : {
            "equal" : "youPassword",
            "equalMessage" : "The two input is different",
            "rules" : "^.{6,23}$",
            "message" : 'Please enter a password with at least 6 bits and up to 23 characters',
        },
        "youCheck" : {
            "type" : 'check',
            "rules" : "^true$",
            "message" : "Please confirm the condition first,请先确定该条件",
        },
        "submit" : {
            'type': 'submit',
        }
    });
});


// validate 
$.fn.validate = function() {
    var validate = false;
    var result = arguments[0];

    for (let key in result) {
        result[key].event = typeof key.event == "undefined" ? 'blur' : key.event;
        if (result[key].type == 'submit')
            result[key].event = 'click';

        $('[name=' + key + ']', $(this)).on(result[key].event, function(e) {
            var Dom = result[key];
            var thisDom = $('[name=' + key + ']');
            if (Dom.event == 'blur') {
                // If the validation is not passed, the error location is identified before the false is returned and output error information
                // 如果验证不通过，返回 false 前先标识出错位置并输出错误信息
                var rules = new RegExp(Dom["rules"]);
                var value = $.trim($('[name=' + key + ']').val());
                // // warningWindow('Test', 'to this !');
                var type = Dom.type;
                var myType;
                var equalDom = Dom['equal'];

                if (result[key].type == 'check')
                    value = thisDom.is(':checked').toString();

                if(rules && !(rules.test(value))) {
                    inputError($('[name=' + key + ']'), Dom['message']);
                    return false;
                }

                // Determines whether the input value of the 2 tags is equal
                // 判定是否相等，２个标签的输入值
                if (typeof equalDom != 'undefined') {
                    if ($(this).val() != $('[name=' + equalDom + ']').val()) {
                        inputError($(this), result[($(this).attr('name'))]["equalMessage"]);
                        return false;
                    }
                }
                thisDom.removeClass('test');
                if (thisDom.next().is('div'))
                    thisDom.next().fadeOut();
                return true;
            } else if (result[key].event == 'click') {
                e.preventDefault();
                validate = true;
                for (var key2 in result) {
                    var dom = $('[name=' + key2 + ']');
                    dom.blur();
                    if (dom.hasClass('test'))
                        validate = false;
                }
                if (validate) {
                    $('#loading').detach().removeClass('template').appendTo('form');
                    var jsonData = {};
                    for (var key2 in result) {
                        var dom1 = $('[name=' + key2 + ']');
                        var value = '';
                        if (dom1.is('[type=checkbox]')) 
                            value = dom1.is(':checked').toString();
                        else
                            value = $.trim(dom1.val());
                        jsonData[key2] = value;
                    }
                    $.post($('from').attr('action'), (jsonData), function(data1, status) {
                        if (status == 'success') {
                            data1 = JSON.parse(data1);
                            if (isError(data1)) 
                                warningWindow(data1.type, data1.text);
                            else if (data1.type == 'success') {
                                var conText = 'registeration successful , please login. <br>注册成功，请登录 <a href="data1.link">' + data1.link + '</a>';
                                warningWindow('<div class="has-success"><label>success, 成功</label></div>', conText);
                                alert('success, Please login!成功!请登录！');
                                window.location.href = data1.link;
                            }
                            // resume login button
                            // 恢复登录按钮
                            $('#loading').addClass('template');
                        } else
                            warningWindow('错误', '注册数据发送失败，请检查是否联网.');
                    });
                }
            }
        });

        // Open the OK button, if all data is properly filled in
        // 开启确定按钮，如果所有数据正确填写

    }
}

// input error
function inputError(dom, message) {
    dom.addClass('test');
    // print error data
    if (!(dom.next().is('div')))
        if(typeof message == 'undefined')
            dom.after($('<div class="error-text"><span>input error</span></div>')).fadeIn();
        else 
            dom.after($('<div class="error-text"><span>' + message + '</span></div>')).fadeIn();
    else 
        dom.next().fadeIn();
    return false;    
}