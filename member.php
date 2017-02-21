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

if(isset($_COOKIE['username'])){
    //获取数据
    $_row = _fetch_array("SELECT tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq,tg_level,tg_reg_time FROM tg_user WHERE  tg_username ='{$_COOKIE['username']}'");
    if ($_row){
        $_html = array();
        $_html['username'] = $_row['tg_username'];
        $_html['sex'] = $_row['tg_sex'];
        $_html['face'] = $_row['tg_face'];
        $_html['email'] = $_row['tg_email'];
        $_html['url'] = $_row['tg_url'];
        $_html['qq'] = $_row['tg_qq'];
        $_html['reg_time'] = $_row['tg_reg_time'];
        $_html = _html($_html);
        switch ($_row['tg_level']){
            case 0:
                $_html['level'] = '普通会员';
                break;
            case 1:
                $_html['level'] = '管理员';
                break;
            default:
                $_html['level'] = '出错';
        }
    }else{
        _alert_back('此用户不存在');
    }
}else{
    _alert_back("非法登录");
}


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
                <dd>用户名: <?php echo $_html['username']?></dd>
                <dd>性别: <?php echo $_html['sex']?></dd>
                <dd>头像: <?php echo $_html['face']?></dd>
                <dd>电子邮件: <?php echo $_html['email']?></dd>
                <dd>主页: <?php echo $_html['url']?></dd>
                <dd>QQ：<?php echo $_html['qq']?></dd>
                <dd>注册时间：<?php echo $_html['reg_time']?></dd>
                <dd>身份：<?php echo $_html['level']?></dd>
            </dl>
        </div>
    </div>


    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
