var SEARCH_PATH = window.location.protocol + '//' +document.domain + '/catalog_view.php';

$(document).ready(function() {
    // connect website and get data
    request = createRequest();
    if (request == null) {
        alert("Unable to create request");
        return ;
    }
    window.history.pushState({}, 0, window.location.href.replace(window.location.pathname, '/'));
    var url = SEARCH_PATH + '?open=' + window.location.protocol + '//' +document.domain;
    loading(url, false);

    // Align vertically to make the file Icon
    // 竖直对齐，使文件图标
    $('.file_type i').css('line-height' , $('.file_type').css('height'));
    // Align vertically to make the name of the file 
    // 竖直对齐，使文件的名称
    $('.file_name span').css('line-height', $('.file_name').css('height'));
    
    $('body').click(function(e) {        
        var _con = $('.kuang');

        if($(e.target).is('input'))
            return false;
        $('.kuang').removeClass('select');
        $('.kuang input').css('display', 'none');
        if (_con.is(e.target) ) {
            $(e.target).addClass('select');
        } else if(_con.has(e.target).length) {
            $(e.target).parents('.kuang').addClass('select');
            $(e.target).parent().next().val($(e.target).text());
            $(e.target).parent().next().fadeIn();
        }
    });

    $('.kuang input').change(function() {
        $(this).prev().children().text($(this).val());
    }).blur(function() {
        $(this).hide();
    });


    // dblclick event, and start when you double click class .kuang
    // 双击事件，如果双击类 kuang 时启动
    $('.kuang').dblclick(function() {
        // deter mine whether it is a file
        // 判定是否为文件
        if($(this).find('i').attr('class').toString().indexOf('folder') === -1) {
            warningWindow('Error', 'can\'t open file');
            return;
        }

        // change website address
        // 改变网站地址
        window.history.pushState({}, 0, encodeURI(window.location.href + $(this).attr('title') + '/'));
        loading(encodeURI(SEARCH_PATH + "?open=" + window.location.href ));
    });
});

$(document).keydown(function(e) {
    if(e.keyCode == 13) {
        $(e.target).blur();
    }
});

function openDir() {
    if(request.readyState == 4) {
        if(!request.status)
            alert('status = ' + request.status);
        if (request.status == 200) {
            $("#content").empty();
            var returnData = eval('(' + request.responseText + ')');
            if(isError(returnData)) {
                warningWindow(returnData.type, returnData.text);
                return;
            }

            // if directory empty alert
            if(!returnData.directory)
                alert('returnData.directory = ' + returnData.directory);
            $('<li></li>').fadeIn('fast').appendTo($('.breadcrumbMine')).append($('<a href="' + returnData.link + '">' + returnData.directory + '</a>').bind('click', function(event) {
                // Generate directory addresses
                // 生成目录地址
                event.preventDefault();
                if (this.className == 'current_directory')
                    return;
                // remove superfluous options
                while (this.parentNode.nextSibling) {
                    this.parentNode.nextSibling.remove();
                }
                this.parentNode.remove();
                window.history.pushState({}, 0, encodeURI(event.target.href));
                loading(encodeURI(SEARCH_PATH + '?open=' + event.target.href));
            }));
            // $('.breadcrumbMine .current_directory').removeClass('current_directory').addClass('disabled');
            $('.breadcrumbMine .current_directory').removeClass('current_directory');
            $(".breadcrumbMine li a:last").addClass('current_directory');

            // redefiningATag();
            var fileList = returnData.fileList;
            for(var arr in fileList) {
                var itm = $('.template.kuang').clone('true');
                itm.removeClass('template').attr({'title': fileList[arr].fileName, 'alt': fileList[arr].fileName});
                itm.children().children().first().addClass(fileList[arr].fileType);
                itm.children().next().children().children().text(fileList[arr].fileName);
                $('#content').append(itm);
            }
        }
    } 
}

function loading(url, async = 'true') {
    // loading icon
    $('#content').append($('#loading').clone().removeClass('template'));
    request.open('GET', url, async);
    request.onreadystatechange = openDir;
    request.send(null);
}

function retrofitting1(obj, arg = '') {
    if(arguments.length == 0) {
        alert('arguments cannot be 0!');
        return;
    } else if(arg == '') {
        return obj;
    }
    alert('arg.fileName = ' + arg.fileName);
    $(obj).children('span').css('outline', '1px red dashed');
    alert('to this function retrofitting1 !');
    return obj;
}

function isError(jsonObject) {
    if(jsonObject.type == 'error')
        return true;
    return false;
}

// warning window , 
function warningWindow(title, text) {
    $('#pop-up-window #myModalLabel').addClass('red').text(title);
    $('#pop-up-window .modal-body').text(text);
    $('#pop-up-window').modal('toggle');
}