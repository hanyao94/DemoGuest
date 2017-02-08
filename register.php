<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/7
 * Time: 14:11
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
define('SCRIPT','register');
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--注册</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript"  src="js/face.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
    <div id="register">
        <h2>会员注册</h2>
        <form action="post.php" name="register" method="post">
            <dl>
                <dt>请认真填写下内容</dt>
                <dd>用  户  名&ensp;：<input type="text" name="username" class="text"/>（*必填，至少两位）</dd>
                <dd>密&ensp;&ensp;&ensp;&ensp;码：<input type="password" name="password" class="text"/>（*必填，至少六位）</dd>
                <dd>确认密码：<input type="password" name="notpassword" class="text"/>（*必填，同上）</dd>
                <dd>密码提示：<input type="text" name="passt" class="text"/>（*必填，至少两位）</dd>
                <dd>密码回答：<input type="text" name="passd" class="text"/>（*必填至少两位）</dd>
                <dd>性    别：<input type="radio" name="sex" value="男" checked="checked" />男 <input type="radio" name="sex" value="女"  />女</dd>
                <dd class="face"><input type="hidden" name="face" value="face/m01.gif"/><img src="face/m01.gif" alt="头像选择" id = "faceimg"/></dd>
                <dd>电子邮件：<input type="text" name="email" class="text"/></dd>
                <dd>&ensp;Q&ensp;&ensp;&ensp;Q&ensp;：<input type="text" name="qq" class="text"/></dd>
                <dd>主页地址：<input type="text" name="url" class="text" value="http://"/></dd>
                <dd>验 证 码&ensp;：<input type="text" name="yzm" class="text yzm"/> <img src="code.php" /></dd>
                <dd><input type = "submit" class="submit" value="注册"/></dd>

            </dl>

        </form>
    </div>



    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
