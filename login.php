<?php
    require_once('./includes/website_data.php');
    // import database
    require_once('./includes/Database.class.php');
    require_once('./includes/User.class.php');
    // return false;

    // Verify that you are already logged in
    // 验证已经登录
    session_start();
    if (false && isset($_SESSION['userId'])) {
        // header('Location:'.WEBSITE_ADDR);
        $jsonData['type'] = 'success';
        $jsonData['link'] = WEBSITE_ADDR;
    } else {
        if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
            $userMail = trim($_POST['youMail']);
            $userPassword = hash('SHA256', trim($_POST['youPassword']));
            $DB = new Database();
            $newUsers = User::findUsers($userMail, $userPassword);
            $usersLength = count($newUsers);

            // validate that user information is successful
            if ($usersLength) {
                $userId = $newUsers[0]['user_id'];
                $_SESSION['userId'] = $userId;
                $jsonData['type'] = 'success';
                $jsonData['link'] = WEBSITE_ADDR;
            } else {
                $jsonData['type'] = 'error';
                $jsonData['text'] = 'The user does not exist. Please check the suer information entered.Or <a href="'. REGISTER_PATH .'">Register new users</a>.<br>用户不存在，请检查输入的用户信息。或<a href="'. REGISTER_PATH .'">注册新用户</a>'. $result;
            }

            echo json_encode($jsonData);
            return ;
        }
    }

    ob_start();

    // seting web title
    $GLOBALS['TEMPLATE']['title'] = 'login';
?>
    <div class="frame gray">
        <div class="middle">
            <div class="window background-color-white radius" id="login">
                <div class="logo theme_color">
                    <a href="<?php echo WEBSITE_ADDR; ?>">
                        <i class="fa fa-cloud fa-3x fa-fw animate-text-hover" aria-hidden="true"></i>
                    </a>
                </div>
                <h1>Sign in</h1>
                <h3>Use your account.</h3>
                <form method="post" action="<?php echo LOGIN_PATH; ?>">
                    <label for="youMail" class="wide">
                        <input type="email" name="youMail" placeholder="Enter your user name" class="wide hover_theme_color" value="<?php
                            echo $userName;
                         ?>">
                    </label>
                    <br>
                    <br>
                    <label for="youPassword" class="wide">
                        <input type="password" name="youPassword" class="wide hover_theme_color" placeholder="Enter your password">
                    </label>
                    <input type="submit" class="wide theme_background_color hover_theme_color white_color center" value="Next">
                    <br>
                    <div>
                        <span>No account?</span><a class="theme_color" href="<?php echo REGISTER_PATH; ?>">Create one!创建用户</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- loading frame -->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.css" />
    <!-- loading icon -->
    <div id="loading" class="loading theme_color template">
        <i class="fa fa-circle-o-notch fa-spin fa-4x fa-fw"></i>
        <span class="sr-only">Loading...</span>
        Loading...
    </div>

    
<?php
    $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    $stylesArray = array('./css/global.css', './css/login.css');
    $GLOBALS['TEMPLATE']['styles'] = $stylesArray;
    ob_end_clean();
?>
<?php
    ob_start();
?>
    <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery-validate/1.17.0/additional-methods.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery-validate/1.17.0/localization/messages_zh.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
<?php 
    $GLOBALS['TEMPLATE']['scriptStream'] = ob_get_contents();
    ob_end_clean();
    require_once './template-page.php';
?>