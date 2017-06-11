<?php
    // default scan address
    define(DEFAULT_PATH, './');
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
        if(!is_dir($dir.$_GET['open'])){
            $jsonData['type'] = 'error';
            $jsonData['text'] = 'not folder';
            echo json_encode((object)$jsonData);
            return;
        }

        $dir = $_GET['open'].'/';
    }
	$file = scandir($dir);
    $jsonData = array();
    foreach ($file as $key => $value) {
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
