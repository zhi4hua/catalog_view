<?php
    

    // default scan address
    define(DEFAULT_PATH, '.');
    define(WEBSITE_ADDR, $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);
    define(ICON_FILE, 'fa fa-file-o');
    define(ICON_FOLDER, 'fa fa-folder');
    define(SIZE_ICON, 'fa-fw fa-2x');

    // verify logon
    // to be continued 

    // if (!isset($_GET['open']))
    //     ob_start();
    if(!isset($dir))
        $dir = DEFAULT_PATH;
    if (isset($_GET['open'])) {
        // if(empty($_SERVER['HTTP_REFERER'])) {
        //         //跳转到网站首页,获取来源网址,即点击来到本页的上页网址
        //         // Jump to the homepage of the website
        //         header('Location:'.WEBSITE_ADDR);
        //         exit();
        // }
        $dir = str_replace(WEBSITE_ADDR, DEFAULT_PATH, $_GET['open']);
        $dir .= '/';
        if(!is_dir($dir)){
            $jsonData['type'] = 'error';
            $jsonData['text'] = 'not folder';
            echo json_encode((object)$jsonData);
            return;
        }
    }

    // Get web site address information
    // 获取网站地址信息
    // $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    // echo '$url = '.$url.nl2br("\n");
    // $dir = $_GET['open'].'/';
	$file = scandir($dir);
    // echo 'dir = '.$dir.nl2br("\n");
    if (!$file) {
        $jsonData['type'] = 'error';
        $jsonData['text'] = 'file read failed';
        echo json_encode($jsonData);
        return;
    }  

    $jsonData = array();
    foreach ($file as $key => $value) {
        // Hide does not display files
        // 隐藏不显示文件
        if (0 === strpos($value, '.')) {
            continue;
        }
        $icon_class = is_dir($dir.$value) ? ICON_FOLDER : ICON_FILE;
        $icon_class.= ' '.SIZE_ICON;

        // json data
        array_push($jsonData, array("fileName"=> $value, "fileType"=> $icon_class));
    }

    // return JSON
    if(isset($_GET['open'])) {
        echo json_encode((object)$jsonData);
    }
    
    // if (!isset($_GET['open'])) {
    //     $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    //     ob_end_clean();
    // }


    // require_once './template-page.html';
?>
