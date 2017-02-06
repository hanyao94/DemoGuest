<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/6
 * Time: 16:06
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}
?>
<div id = "header">
    <h1><a href="index.php">瓢城Web俱乐部多用户留言系统</a></h1>
    <ul>
        <li>首页</li>
        <li>注册</li>
        <li>登录</li>
        <li>个人中心</li>
        <li>风格</li>
        <li>管理</li>
        <li>退出</li>
    </ul>
</div>
