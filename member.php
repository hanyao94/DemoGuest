<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/20
 * Time: 16:01
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','member');

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--个人中心</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
    <div id="member">
        <?php require ROOT_PATH.'includes/member.inc.php'?>
        <div id="member_main">
            <h2>会员管理中心</h2>
            <dl>
                <dd>用户名: 炎日</dd>
                <dd>性别: 男</dd>
                <dd>头像: face/m01.gif</dd>
                <dd>电子邮件: yc60.com@gmail.com</dd>
                <dd>主页: http:dddddd</dd>
                <dd>QQ：sssssss</dd>
                <dd>注册时间：2015-10-15</dd>
                <dd>身份：管理员</dd>
            </dl>
        </div>
    </div>


    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
