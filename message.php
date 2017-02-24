<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/22
 * Time: 14:58
 */
session_start();
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','message');

//判断是否登录了
if (!isset($_COOKIE['username'])){
    _alert_close('请先登录!');
}
//写短信
if (@$_GET['action']=='write'){
    //为了防止恶意注册，跨站攻击
    _check_code($_POST['code'],$_SESSION['code']);

    if(!!$_rows =_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'LIMIT 1")) {

        //为了防止cookies伪造，还要比对下唯一标识符uniqid()
        _uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']);

        include ROOT_PATH.'includes/check.func.php';

        $_clean = array();
        $_clean['touser'] = $_POST['touser'];
        $_clean['fromuser'] = $_COOKIE['username'];
        $_clean['content'] = _check_content($_POST['content']);
        $_clean = _mysql_string($_clean);

        //写入表
        _query("INSERT INTO tg_message(
                                    tg_touser,
                                    tg_fromuser,
                                    tg_content,
                                    tg_date
                         )VALUE(
                                  '{$_clean['touser']}',
                                  '{$_clean['fromuser']}',
                                  '{$_clean['content']}',
                                  '" . date('y-m-d H:i:s') . "'
                                )      
                            ");
        //新增成功
        if (_affected_row() == 1){
            //关闭数据库
            _close();
            _session_destroy();
            //跳转函数
           _alert_close('短信发送成功');
        }else{
            _close();
            _session_destroy();
            _alert_back('短信发送失败');
        }
    }else{
        _alert_close("非法登录");
    }
}

//获取数据
if(isset($_GET['id'])){
    if (!!$_row=_fetch_array("SELECT tg_username FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1")){
        $_html = array();
        $_html['touser'] = $_row['tg_username'];
        $_html = _html($_html);
    }else{
        _alert_close('不存在此用户！');
    }
}else{
    _alert_close('非法操作');
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--写短信</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>

    <script type="text/javascript"  src="js/code.js"></script>
    <script type="text/javascript"  src="js/message.js"></script>
</head>
<body>

    <div id="message">
        <h3>写短信</h3>
        <form action="?action=write" method="post">
            <input type="hidden" class="text" name="touser" value="<?php echo $_html['touser'] ?>"/>
        <dl>
            <dd><input type="text" class="text" value="TO <?php echo $_html['touser'] ?>"/></dd>
            <dd><textarea name="content" ></textarea></dd>
            <dd>验 证 码&ensp;：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code" /> <input type = "submit" class="submit" value="发送短信"/></dd>
        </dl>
        </form>
    </div>


</body>
</html>
