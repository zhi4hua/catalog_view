<?php
    require_once('./includes/website_data.php');
    ob_start();

    // Verify that you are already logged in
    // 验证已经登录
    session_start();
    if ($_SESSION['userName'])
    {
        echo '<h1>'.$_SESSION['userName'].'</h1>';
    }

    // seting web title
    $GLOBALS['TEMPLATE']['title'] = 'login';
?>
    <div class="login_frame theme_color">
        <div class="middle">
            <div class="login" id="login">
                <div class="logo">
                    logo
                </div>
                <h1>Sign in</h1>
                <h3>Use your account.</h3>
                <form method="post" action="<?php echo LOGIN_PATH; ?>">
                    <label for="name" class="wide">
                        <input type="email" name="name" placeholder="Enter your user name" class="wide hover_theme_color" value="<?php
                            echo $userName;
                         ?>">
                    </label>
                    <br />
                    <input type="submit" class="wide theme_background_color hover_theme_color white_color center" value="Next">
                    <div>
                        <span>No account?</span><a href="#">Create one!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php
    $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    $stylesArray = array('https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css', './css/global.css', './css/login.css');
    $GLOBALS['TEMPLATE']['styles'] = $stylesArray;
    ob_end_clean();
?>
<?php
    ob_start();
?>
    <script type="text/javascript" src="./js/login.js"></script>
<?php 
    $GLOBALS['TEMPLATE']['scriptStream'] = ob_get_contents();
    ob_end_clean();
    require_once './template-page.php';
?>