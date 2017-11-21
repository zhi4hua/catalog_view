<?php
    require_once('./includes/website_data.php');

    session_start();
    // if not logged in
    // 如果没有登录
    logged();


    // is ajax request
    if (isAjax()) {

        // default scan address
        define(DEFAULT_PATH, './');
        define(DEFAULT_NAME, 'home');
        define(ICON_FILE, 'fa fa-file-o');
        define(ICON_FOLDER, 'fa fa-folder');
        define(SIZE_ICON, 'fa-fw fa-2x');

        if(!isset($dir))
            $dir = DEFAULT_PATH;
        // test code , for website hostinger
        // 测试代码，用于网站 hostinger
        // if(!isset($_GET['open']))
        //     $_GET['open'] = WEBSITE_ADDR;

        if($_SERVER['HTTP_REFERER'] == WEBSITE_ADDR) {
            $jsonData['type'] = 'error';
            $jsonData['text'] = 'Test coding';
            echo json_encode((object)$jsonData);
            // header('Location:'.WEBSITE_ADDR.'/template-page.html');
        }
        if (isset($_GET['open'])) {
            // if(empty($_SERVER['HTTP_REFERER'])) {
            //         //跳转到网站首页,获取来源网址,即点击来到本页的上页网址
            //         // Jump to the homepage of the website
            //         header('Location:'.WEBSITE_ADDR);
            //         exit();
            // }
            $dir = str_replace(WEBSITE_ADDR, DEFAULT_PATH, $_GET['open']);
            if(!is_dir($dir)){
                $jsonData['type'] = 'error';
                $jsonData['text'] = 'not folder';
                echo json_encode((object)$jsonData);
                return false;
            }
        } else {
            $jsonData['type'] = 'error';
            $jsonData['text'] = '$_GET[\'open\'] is nothing!';
            echo json_encode((object)$jsonData);
            // header('Location:'.WEBSITE_ADDR.'/template-page.html');
        }

        $file = scandir($dir);
        // echo 'dir = '.$dir.nl2br("\n");
        if (!$file) {
            $jsonData['type'] = 'error';
            $jsonData['text'] = 'file read failed';
            echo json_encode($jsonData);
            return;
        }  

        $file_list = array();
        foreach ($file as $key => $value) {
            // Hide does not display files
            // 隐藏不显示文件
            if ('.' === $value) {
                continue;
            }
            if('..' === $value)
                continue;
            $icon_class = is_dir($dir.$value) ? ICON_FOLDER : ICON_FILE;
            $icon_class.= ' '.SIZE_ICON;

            // json data
            array_push($file_list, array("fileName"=> $value, "fileType"=> $icon_class));
        }

        // Returns the query directory name
        // 返回被查询目录名
        if ($_GET['open'] == WEBSITE_ADDR || $_GET['open'] == WEBSITE_ADDR.'/') {
            $dir_name = DEFAULT_NAME;
        } else {
            // explode — 使用一个字符串分割另一个字符串
            // http://php.net/manual/zh/function.explode.php
            // $dir_array = explode('/', $dir);
            // $dir_name = $dir_array[(int) count($dir_array) - 2];

            // another way
            $dir_name = basename($_GET['open']);
        }

        $jsonData = array( 
                            'directory' => $dir_name,
                            'link' => $_GET['open'],
                            'fileList'=> $file_list
                           );
        // return JSON
        if(isset($_GET['open'])) {
            header('Cache-Control: private');
            echo json_encode((object)$jsonData);
            return;
        }
    }

    // Reference template page, if not ajax request
    ob_start();
?>
    <!-- User information -->
    <div class="nav  breadcrumbMine" id="nav">
        <ul class="nav  menubar-height dropdown-menu-right pull-right">
            <li>
                <a class="btn dropdown-toogle theme_color haver_color"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="dropdownMenu1" href="#"><i class="fa fa-user-o fa-fw"></i>&nbsp;&nbsp;<span id="user_name">user name</span>&nbsp;&nbsp;<span class="caret"></span></a>
                <ul class="dropdown-menu same-width" aria-labelledby="dropdownMenu1">
                    <li class="wide"><a class="btn theme_color" href="#">Setting</a></li>
                    <li class="wide"><a class="btn theme_color" href="#">about</a></li>
                </ul>
            </li>
            <li ><a class="btn theme_color haver_color" href="http://www.php6.org/login.php?exit=true" id="exit">exit</a></li>
        </ul>
    </div>
    <!-- End User information -->
    <!-- path div  -->
    <div id="path" class="path nav">
        <ul class="breadcrumbMine">
        </ul>
    </div>
    <div id="content" class="content">
    </div>
    <div class="kuang template " title="file name" alt="file name">
       <div class="file_type "><i class=""></i></div>
       <div class="file_name">
           <a href="javascript:void(0)" class="beFilledWith">
               <span >file name</span>
           </a>
           <input value="file name" type="text" />
       </div>
    </div>

<?php
    $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    ob_end_clean();
?>

<?php 
    // include css file
    ob_start();
?>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/catalog_view.css">
<?php
    $GLOBALS['TEMPLATE']['styleStream'] = ob_get_contents();
    ob_end_clean();
?>

<?php 
    // include javascript file
    ob_start();
?>
    <script type="text/javascript" src="./js/thumbnails.js"></script>
    <script type="text/javascript" src="./js/predeterminedVariables.js"></script>
    <script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="./js/catalog_view.js"></script>
<?php
    $GLOBALS['TEMPLATE']['scriptStream'] = ob_get_contents();
    ob_end_clean();
?>

<?php
    // Reference template page
    require_once './template-page.php';
?>