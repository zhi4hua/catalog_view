<?php
    
    // The directory where the source code is located
    // 源代码所在的目录
    define(DIRECTORY, dirname($_SERVER['PHP_SELF']) == '/' ? '' : dirname($_SERVER['PHP_SELF']));

    // domain name
    // 域名
    define(WEBSITE_ADDR, $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

    // address of the login page
    // 登录页面的路径
    define(LOGIN_PATH, WEBSITE_ADDR.'/login.php');

    // address of the register page
    // 注册页面路径
    define(REGISTER_PATH, WEBSITE_ADDR.'/register.php');

    // path, pointing function function
    // 路径，指向功能函数
    define(INCLUDES_PATH, WEBSITE_ADDR.'/includes');

    // Database page path
    // 数据库页面路径
    define(DATABASE_PATH, WEBSITE_ADDR.INCLUDES_PATH.'/Database.class.php');

    // table prefix
    // 表名前缀
    define(TABLE_PREFIX, 'website_');

    // 
    function isAjax() {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
    }
?>