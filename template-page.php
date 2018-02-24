<?php
    require_once('./includes/website_data.php');
    
    logged();
?>

<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 将下面的 <meta> 标签加入到页面中，可以让部分国产浏览器默认采用高速模式渲染页面 -->
        <meta name="renderer" content="webkit">
        <title>
            <?php
                if (!empty($GLOBALS['TEMPLATE']['title']))
                {
                    echo $GLOBALS['TEMPLATE']['title'];
                } else
                    echo WEBSITE_ADDR;
            ?>
        </title>
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
           <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
           <!--[if lt IE 9]>
             <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
             <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->        
    </head>
    <body>
        <noscript>
            <h1>SWEET! Please open the browser JavaScript function</h1>
            <h1>请开启浏览器的JavaScript功能</h1>
        </noscript>
        
        <!-- Pop-up window -->
        <!-- 弹跳式窗口 -->
        <div class="modal fade" id="pop-up-window" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ... some thing
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
        </div>

        <!-- loading icon -->
        <div id="loading" class="loading theme_color template">
            <i class="fa fa-circle-o-notch fa-spin fa-4x fa-fw"></i>
            <span class="sr-only">Loading...</span>
            Loading...
        </div>

        <?php 
            if (!empty($GLOBALS['TEMPLATE']['content']))
            {
                echo $GLOBALS['TEMPLATE']['content'];
            } else {
                echo '<div><h1 class="error">Error, empty!</h1></div>';
            }
        ?>
       
       <!-- icon css -->
       <!-- 图标的样式 -->
       <link rel="stylesheet" type="text/css" href="./css/font-awesome.css" />
       <link rel="stylesheet" href="./css/global.css">
        <!-- include style -->
        <?php
            if (!empty($GLOBALS['TEMPLATE']['styleStream']))
                echo $GLOBALS['TEMPLATE']['styleStream'];
            if (!empty($GLOBALS['TEMPLATE']['styles']))
            {
                $stylesList = $GLOBALS['TEMPLATE']['styles'];
                if (is_array($stylesList)) 
                {
                   foreach ($stylesList as $styleName) 
                   {
                        echo '<link rel="stylesheet" type="text/css" href="'.$styleName.'" />';
                   }
                } else if (is_string($stylesList))
                {
                    echo '<link rel="stylesheet" type="text/css" href="'.$stylesList.'" />';
                }
            }
        ?>

        <!-- include jquery libary -->
        <script type="text/javascript" src="./js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="./js/global.js"></script>
        <?php
            if (!empty($GLOBALS['TEMPLATE']['scriptStream']))
            {
                echo $GLOBALS['TEMPLATE']['scriptStream'];
            }
        ?>
    </body>
</html>

<!-- <?php
    

    // <!-- crate and wirte files -->
    // <!-- 创建并写入文件 -->

    // <!-- Postpone the test until the login page is complete -->
    // <!-- 延后测试，延后到login 页面完成后 -->
    // get html data
    // 获取数据
    // $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    // ob_end_clean();

    // $fileName = './'.$GLOBALS['TEMPLATE']['title'].'_2.html';
    // echo 'write file name : '.$fileName.nl2br("\n");
    // $fileLinks = fopen($fileName, 'w') or die('Unable to open files!无法打开文件');
    // fwirte($fileLinks, $GLOBALS['TEMPLATE']['content']) or die('Unable to write files!无法写入文件');
    // fclose($fileLinks);
    // header('Location:'.WEBSITE_ADDR);
?> -->