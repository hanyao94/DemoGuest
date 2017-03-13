<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/22
 * Time: 17:52
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','member_message');

//批删除短信
if (@$_GET['action'] == 'delete'&&isset($_POST['ids'])){
    $_clean = array();
    $_clean['ids']= _mysql_string(implode(',',$_POST['ids']));
    //当你进行危险操作时，要进行唯一标识符的验证
    if(!!$_rows =_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'LIMIT 1")) {
        //为了防止cookies伪造，还要比对下唯一标识符uniqid()
        _uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']);

        //批删除短信
        _query("DELETE FROM tg_message WHERE tg_id IN ({$_clean['ids']})");
        if (_affected_row()){
            //关闭数据库
            _close();
            //跳转函数
            _location('短信删除成功','member_message.php');
        }else{
            _close();
            _alert_back('短信删除失败');
        }
    }else{
        _alert_back('非法登录');
    }

}

//分页模块
_page('SELECT tg_id FROM tg_message',15); //sql取得数据，每页条数

//从数据库提取数据
//我们必须是每次从新读取结果集，而不是每次从新去执行sql
$_result = _query("SELECT tg_id,tg_fromuser,tg_content,tg_date FROM tg_message ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--短信列表</title>
    <?php
    require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
<div id="member">
    <?php require ROOT_PATH.'includes/member.inc.php'?>
    <div id="member_main">
        <h2>短信管理中心</h2>
        <form action="?action=delete" method="post">
        <table cellspacing="1">
            <th>发信人</th><th>短信内容</th><th>时间</th><th>操作</th>
            <?php while (!!$_rows = _fetch_array_list($_result)) {
                $_html = array();
                $_html['id'] = $_rows['tg_id'];
                $_html['fromuser'] = $_rows['tg_fromuser'];
                $_html['content'] = $_rows['tg_content'];
                $_html['date'] = $_rows['tg_date'];
                $_html = _html($_html);
                ?>
                <tr>
                    <td><?php echo $_html['fromuser'] ?></td>
                    <td><a href="member_message_detail.php?id=<?php echo $_html['id'] ?>"><?php echo _title($_html['content']) ?></a></td>
                    <td><?php echo $_html['date'] ?></td>
                    <td><input name="ids[]" value="<?php echo $_html['id']?>" type="checkbox"/></td>
                </tr>

                <?php
            }
            _free($_result);

            ?>
            <tr>
                <td colspan="4">
                    <label for="all">全选 <input type="checkbox" name="chkall" id="all"/></label>
                    <input type="submit" value="批删除"/>
                </td>
            </tr>
        </table>
        </form>
        <?php
            _paging(2);//输出分页，1数字分页，2文本分页
        ?>
    </div>

</div>
    <?php
    require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
