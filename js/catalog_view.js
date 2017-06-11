var SEARCH_PATH = window.location.protocol + '//' +document.domain + '/catalog_view.php';
var currentDirectory = (window.location.href + "").substr(0, window.location.href.indexOf(window.location.pathname) + 1);

$(document).ready(function() {
    // connect website and get data
    request = createRequest();
    if (request == null) {
        alert("Unable to create request");
        return ;
    }
    var url = SEARCH_PATH + '?open=.';
    loading(url, false);
    window.history.pushState({}, 0, window.location.protocol + '//' +document.domain + '/' );

    $('.file_type i').css('line-height' , $('.file_type').css('height'));
    
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

    $('.kuang').dblclick(function() {
        // deter mine whether it is a file
        // 判定是否为文件
        // if($(this).find('i').attr('class').toString().indexOf('folder') === -1) {
        //     alert('cannt open ');
        //     return;
        // }
        window.history.pushState({}, 0, SEARCH_PATH + "?open=" + escape($(this).attr('title')));
        var url = window.location.href ;
        loading(url);
        window.history.pushState({}, 0, currentDirectory + escape($(this).attr('title')) + '/');
    });

    // pop-up window set
    $('#myModal').modal('toggle');
    alert('to this !');
});

$(document).keydown(function(e) {
            if(e.keyCode == 13) {
                $(e.target).blur();
            }
});

function openDir() {
    if(request.readyState == 4) {
        if (request.status == 200) {
            $("#content").empty();
            var returnData = eval('(' + request.responseText + ')');
            if(isError(returnData)) {
                alert('error: ' + returnData.text);
                return;
            }
            for(var arr in returnData) {
                var itm = $('.template.kuang').clone();
                itm.removeClass('template').attr({'title': returnData[arr].fileName, 'alt': returnData[arr].fileName});
                itm.children().children().first().addClass(returnData[arr].fileType);
                itm.find('span').text(returnData[arr].fileName);
                $('#content').append(itm);
            }
        }
    } 
}

function loading(url, async = 'true') {
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