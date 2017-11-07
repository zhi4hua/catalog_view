<?php
    // import website data
    require_once('./includes/website_data.php');

    // set time zone
    date_default_timezone_set('Asia/Chongqing');

    // register page
    // author : ZhiHua Wu
    // time : 2017-08-13 15:04

    if (!session_start())
        die('session error');

    // $_SESSION['userId'] = 'zhi4hua';

    // Has become a site user, jump to the user interface
    // 已经成为网站用户，跳转至用户界面
    if (isset($_SESSION['userId'])) {
        // header('Location:'.WEBSITE_ADDR);
    }

    // Come to register and submit registration information
    // 前来注册，并提交注册信息

    // Determine whether it is Ajax
    // 判断是否为ajax
    if (isAjax()) {
        header("Content-type:text/html;charset=utf8");

        $userMail = trim($_POST['youMail']);
        $userPassword = trim($_POST['youPassword']);
        $userConfirmPassword = trim($_POST['youConfirmPassword']);
        if ($userPassword == $userConfirmPassword && !empty($userPassword)) {
            require_once('./includes/User.class.php');
            // create user
            $newUser = new User($userMail, hash("sha256", $userPassword));
            if ($newUser->isError())
                die('user create error');
            require_once('./includes/Database.class.php');
            $dbLink = new Database();
            if (Database::getDB()) {
                // verify that it is repeated
                if (User::repeat($newUser)) {
                    $returnData['type'] = 'error';
                    $returnData['text'] .= 'Registration failed because the email address has been registered! Please change or log in directly!<br>注册失败，原因该邮件地址已经注册！请换个，或直接<a href="'. LOGIN_PATH. '">登录</a>';
                    
                } else {                    
                    // register user
                    User::addAUser($newUser);
                    // $returnData = 'login was successful!login addr : '. LOGIN_PATH.nl2br("\n");
                    $returnData['type'] = 'success';
                    $returnData['link'] = LOGIN_PATH;
                    echo json_encode($returnData);
                    return ;
                }
            } else {
                $returnData['type'] = 'error';
                $returnData['text'] = $dbLink->getErrorText();
                $returnData['text'] = '请联系网站客服，说明无法访问数据库!Please contact the website customer service, indicating that you cannot access the database';
            }
        } else
            $returnData = 'error! password : '.$userPassword.' Confirm password : '.$userConfirmPassword.' mail : '.$userMail;
        echo json_encode($returnData);
        return ;
    }

    ob_start();
?>
    <div id="register_frame" class="frame gray">
        <div class="middle">
            <!-- <svg class="background-image template" jsname="BUfzDd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 810" preserveAspectRatio="xMinYMin slice" aria-hidden="true"><path fill="#efefee" d="M592.66 0c-15 64.092-30.7 125.285-46.598 183.777C634.056 325.56 748.348 550.932 819.642 809.5h419.672C1184.518 593.727 1083.124 290.064 902.637 0H592.66z"></path><path fill="#f6f6f6" d="M545.962 183.777c-53.796 196.576-111.592 361.156-163.49 490.74 11.7 44.494 22.8 89.49 33.1 134.883h404.07c-71.294-258.468-185.586-483.84-273.68-625.623z"></path><path fill="#f7f7f7" d="M153.89 0c74.094 180.678 161.088 417.448 228.483 674.517C449.67 506.337 527.063 279.465 592.56 0H153.89z"></path><path fill="#fbfbfc" d="M153.89 0H0v809.5h415.57C345.477 500.938 240.884 211.874 153.89 0z"></path><path fill="#ebebec" d="M1144.22 501.538c52.596-134.583 101.492-290.964 134.09-463.343 1.2-6.1 2.3-12.298 3.4-18.497 0-.2.1-.4.1-.6 1.1-6.3 2.3-12.7 3.4-19.098H902.536c105.293 169.28 183.688 343.158 241.684 501.638v-.1z"></path><path fill="#e1e1e1" d="M1285.31 0c-2.2 12.798-4.5 25.597-6.9 38.195C1321.507 86.39 1379.603 158.98 1440 257.168V0h-154.69z"></path><path fill="#e7e7e7" d="M1278.31,38.196C1245.81,209.874 1197.22,365.556 1144.82,499.838L1144.82,503.638C1185.82,615.924 1216.41,720.211 1239.11,809.6L1439.7,810L1439.7,256.768C1379.4,158.78 1321.41,86.288 1278.31,38.195L1278.31,38.196z"></path></svg> -->
            <div id="register" class="window background-color-white">
                <form action="<?php echo REGISTER_PATH; ?>" method="post">
                    <div class="logo theme_color">
                        <i class="fa fa-cloud fa-3x fa-fw animate-text-hover" aria-hidden="true"></i>
                    </div>
                    <p><?php echo $_SESSION['userId']; ?></p>
                    <h1>创建账户</h1>
                    <!-- <label for="youName">您的姓名</label> -->
                    <!-- <input type="text" name="youName" id="youName" maxlength="50" class="wide hover_theme_color" data-placement="bottom" title="Please enter the content!请输入内容" value="<?php echo $userName; ?>"> -->
                    <!-- <br> -->
                    <!-- <br> -->
                    <!-- 暂不使用手机验证功能，原因无法免费收发验证短信 -->
                    <!-- Temporarily do not use the mobile phone authentication function, the reason can not send and receive proof free SMS -->
                    <!-- <label for="youPhone">手机号码</label>
                    <input type="tel" name="youPhone" class="wide hover_theme_color">
                    <br>
                    <br> -->
                    <label for="youMail">电子邮件地址</label>
                    <input type="email" name="youMail" maxlength="64" class="wide hover_theme_color" value="<?php echo $userMail; ?>"  >
                    <br>
                    <br>
                    <label for="youPassword">密码</label>
                    <input type="password" name="youPassword" class="wide hover_theme_color">
                    <br>
                    <br>
                    <label for="">确定密码</label>
                    <input type="password" name="youConfirmPassword" class="wide hover_theme_color">
                    <br>
                    <label class="" for="youCheck">
                        <input type="checkbox" id="youCheck" name="youCheck" class="middle hover_theme_color">
                        <span class="a-checkbox-label black">我已阅读并同意网站的使用条件及隐私声明</span>
                    </label>
                    <input type="submit" name="submit" value="继续" class="wide theme_background_color hover_theme_color white_color center theme_border_color" id="mySubmit">
                    <div class="wide" >
                        <span class="small-font">
                            已拥有帐户？
                                <a href="<?php echo LOGIN_PATH; ?>">登录</a>
                        <span>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    $GLOBALS['TEMPLATE']['content'] = ob_get_contents();
    ob_end_clean();
    ob_start();
?>
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.css" />
    <link type="text/css" rel="stylesheet" href="./css/global.css" />
    <link type="text/css" rel="stylesheet" href="./css/register.css" />
<?php
    $GLOBALS['TEMPLATE']['styleStream'] = ob_get_contents();
    ob_end_clean();
?>
<?php 
    ob_start();
?>
    <!-- json2 cdn -->
    <!-- <script src="//cdn.bootcss.com/json2/20160511/json2.js"></script> -->
    <script type="text/javascript" src="./js/json2.js"></script>
    <script src="./js/bootstrap.min.js" ></script>
    <!-- <script src="//cdn.bootcss.com/jquery.serializeJSON/2.8.1/jquery.serializejson.min.js"></script> -->
    <script type="text/javascript" src="./js/register.js"></script>
<?php
    $GLOBALS['TEMPLATE']['scriptStream'] = ob_get_contents();
    ob_end_clean();
    require_once('./template-page.php');
?>