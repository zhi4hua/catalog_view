<?php     
    // include website data
    require_once('./includes/website_data.php');
    session_start();

    // Test romate database
    header("Location:". WEBSITE_ADDR. '/Test_menu_bootstrap.php');

    // if not logged in
    // 如果没有登录
    // if (!isset($_SESSION['userId']) || empty($_SESSION['userId'])){
    //     header('Location:'. LOGIN_PATH);
    // }
    // else {
    //     header('Location:'.WEBSITE_ADDR.'/catalog_view.php');
    // }
    session_write_close();
?>
