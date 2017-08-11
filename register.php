<?php
    // register page
    ob_start();
?>
    <div id="register_frame" class="frame gray">
        <div class="middle">
            <svg class="background-image template" jsname="BUfzDd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 810" preserveAspectRatio="xMinYMin slice" aria-hidden="true"><path fill="#efefee" d="M592.66 0c-15 64.092-30.7 125.285-46.598 183.777C634.056 325.56 748.348 550.932 819.642 809.5h419.672C1184.518 593.727 1083.124 290.064 902.637 0H592.66z"></path><path fill="#f6f6f6" d="M545.962 183.777c-53.796 196.576-111.592 361.156-163.49 490.74 11.7 44.494 22.8 89.49 33.1 134.883h404.07c-71.294-258.468-185.586-483.84-273.68-625.623z"></path><path fill="#f7f7f7" d="M153.89 0c74.094 180.678 161.088 417.448 228.483 674.517C449.67 506.337 527.063 279.465 592.56 0H153.89z"></path><path fill="#fbfbfc" d="M153.89 0H0v809.5h415.57C345.477 500.938 240.884 211.874 153.89 0z"></path><path fill="#ebebec" d="M1144.22 501.538c52.596-134.583 101.492-290.964 134.09-463.343 1.2-6.1 2.3-12.298 3.4-18.497 0-.2.1-.4.1-.6 1.1-6.3 2.3-12.7 3.4-19.098H902.536c105.293 169.28 183.688 343.158 241.684 501.638v-.1z"></path><path fill="#e1e1e1" d="M1285.31 0c-2.2 12.798-4.5 25.597-6.9 38.195C1321.507 86.39 1379.603 158.98 1440 257.168V0h-154.69z"></path><path fill="#e7e7e7" d="M1278.31,38.196C1245.81,209.874 1197.22,365.556 1144.82,499.838L1144.82,503.638C1185.82,615.924 1216.41,720.211 1239.11,809.6L1439.7,810L1439.7,256.768C1379.4,158.78 1321.41,86.288 1278.31,38.195L1278.31,38.196z"></path></svg>
            <div id="register" class="content background-color-white">
                <div class="logo theme_color">
                    <i class="fa fa-cloud fa-3x fa-fw animate-text-hover" aria-hidden="true"></i>
                </div>
                <h1>创建账户</h1>
                <label for="youName">您的姓名</label>
                <input type="text" name="youName" id="youName" maxlength="50" class="wide hover_theme_color">
                <br>
                <br>
                <label for="youPhone">手机号码</label>
                <input type="tel" name="youPhone" class="wide">
                <br>
                <br>
                <label for="youMail">电子邮件地址</label>
                <input type="email" name="youMail" maxlength="64" class="wide hover_theme_color">
                <br>
                <br>
                <label for="youPassword">密码</label>
                <input type="password" name="youPassword" class="wide">
                <label class="" for="youEheck">
                    <input type="checkbox" name="youEheck" class="middle">
                    <span class="a-checkbox-label black">我已阅读并同意网站的使用条件及隐私声明</span>
                    <input type="submit" name="" class="wide theme_background_color hover_theme_color white_color center theme_border_color">
                </label>
            </div>
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
    <script type="text/javascript" src="./js/register.js"></script>
<?php
    $GLOBALS['TEMPLATE']['scriptStream'] = ob_get_contents();
    ob_end_clean();
    require_once('./template-page.php');
?>