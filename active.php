<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/15
 * Time: 11:06
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','active');
if (!isset($_GET['active'])){
    _alert_back('非法操作');
}

if (isset($_GET['action'])&&isset($_GET['active'])&&$_GET['action']=='ok'){
    $_active = ($_GET['active']);
    if (_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='$_active' LIMIT 1")){
        //将tg_active 设置为空
        _query("UPDATE tg_user SET tg_active='' WHERE tg_active='$_active' LIMIT 1");
        if (_affected_row() == 1){
            _close();
            _location("账户激活成功","login.php");
        }else{
            _close();
            _location("账户激活失败","register.php");
        }
    }else{
        _alert_back('非法操作');
    }
}
//开始激活处理
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--激活</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript"  src="js/register.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>

    <div id="active">
        <h2>激活账户</h2>
        <p>本页面是为了模拟您的邮件的功能，点击超级链接激活您的账户</p>
        <p><a href="active.php?action=ok&amp;active=<?php echo @$_GET['active']?>"><?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo @$_GET['active']?></a> </p>
    </div>

    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
