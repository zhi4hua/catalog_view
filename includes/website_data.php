<?php
    // domain name
    // 域名
    define(WEBSITE_ADDR, $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

    // address of the login page
    // 登录页面的路径
    define(LOGIN_PATH, WEBSITE_ADDR.'/login.php');

    // address of the register page
    // 注册页面路径
    define(REGISTER_PATH, WEBSITE_ADDR.'/register.php');
?>