<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/24
 * Time: 10:32
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','member_message_detail');

//删除短信模块
if (@$_GET['action']=='delete'&&isset($_GET['id'])){
    //这是验证短信是否合法
    if (!!$_row = _fetch_array("SELECT tg_id FROM tg_message WHERE  tg_id ='{$_GET['id']}'LIMIT 1")){
        //当你进行危险操作时，要进行唯一标识符的验证
        if(!!$_rows =_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'LIMIT 1")) {
            //为了防止cookies伪造，还要比对下唯一标识符uniqid()
            _uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']);
           //删除单短信
            _query("DELETE FROM tg_message WHERE tg_id= '{$_GET['id']}' LIMIT 1");
            if (_affected_row() == 1){
                //关闭数据库
                _close();
                _session_destroy();
                //跳转函数
                _location('短信删除成功','member_message.php');
            }else{
                _close();
                _session_destroy();
                _alert_back('短信删除失败');
            }

        }else{
            _alert_back('非法登录');
        }
    }else{
        _alert_back('此短信不存在');
    }



    exit();
}

if (!isset($_COOKIE['username'])){
    _alert_back('请先登录！');
}

if (isset($_GET['id'])){
    //获取数据
    if (!!$_row = _fetch_array("SELECT tg_id,tg_fromuser,tg_content,tg_date FROM tg_message WHERE  tg_id ='{$_GET['id']}'LIMIT 1")){
        $_html = array();
        $_html['id'] = $_row['tg_id'];
        $_html['fromuser'] = $_row['tg_fromuser'];
        $_html['content'] = $_row['tg_content'];
        $_html['date'] = $_row['tg_date'];
        $_html = _html($_html);
    }else{
        _alert_back('此短信不存在');
    }
}else{
    _alert_back('非法登录');
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--短信详情</title>
    <?php
    require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>

    <script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
    <div id="member">
        <?php require ROOT_PATH.'includes/member.inc.php'?>
        <div id="member_main">
            <h2>短信详情中心</h2>
            <dl>
                <dd>发件人：<?php echo $_html['fromuser'] ?></dd>
                <dd>内容：<?php echo $_html['content'] ?></dd>
                <dd>收件人：<?php echo $_html['date'] ?></dd>
                <dd class="button"><input type="button" value="返回列表" id="return"/> <input type="button" name ="<?php echo $_html['id'] ?>" value="删除" id="delete" /></dd>
            </dl>
        </div>

    </div>
    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
