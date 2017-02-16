<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/16
 * Time: 10:38
 */
session_start();
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','login');

//开始处理登录状态
if (@$_GET['action'] == 'login'){
    exit('123');
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--登录</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
<script type="text/javascript"  src="js/code.js"></script>
<script type="text/javascript"  src="js/login.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>

    <div id="login">
        <h2>登录</h2>
        <form action="login.php?action=login" name="login" method="post">
            <dl>
                <dt> </dt>
                <dd>用  户  名&ensp;：<input type="text" name="username" class="text"/></dd>
                <dd>密&ensp;&ensp;&ensp;&ensp;码：<input type="password" name="password" class="text"/></dd>
                <dd>保&ensp;&ensp;&ensp;&ensp;留：<input type="radio" name="time" value="0" checked/>不保留 <input type="radio" name="time" value="1" /> 一天<input type="radio" name="time" value="2" /> 一周 <input type="radio" name="time" value="3" />一个月</dd>
                <dd>验 证 码&ensp;：<input type="text" name="code" class="text code"/> <img src="code.php" id="code" /></dd>
                <dd><input type="submit" value="登录" class="button"/>    <input type="submit" value="注册" class="button location" id="location"/></dd>
            </dl>

        </form>
    </div>

    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
