<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/20
 * Time: 16:01
 */

session_start();
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','member_modify');

if(@$_GET['action'] == 'modify'){
    //为了防止恶意注册，跨站攻击
    _check_code($_POST['code'],$_SESSION['code']);

   if(!!$_rows =_fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'LIMIT 1")) {
       //为了防止cookies伪造，还要比对下唯一标识符uniqid()
       _uniqid($_rows['tg_uniqid'], $_COOKIE['uniqid']);
       //引入验证文件
       include ROOT_PATH . 'includes/check.func.php';

       //创建一个空数组，用来存放提交过来的合法数据
       $_clean = array();

       $_clean['password'] = _check_password_modify($_POST['password'], 6);
       $_clean['sex'] = _check_sex($_POST['sex']);
       $_clean['face'] = _check_face($_POST['face']);
       $_clean['email'] = _check_email($_POST['email'], 6, 40);
       $_clean['QQ'] = _check_QQ($_POST['qq']);
       $_clean['url'] = _check_url($_POST['url'], 40);

       if (empty($_clean['password'])) {
           _query("UPDATE tg_user SET 
                                    tg_sex='{$_clean['sex']}',
                                    tg_face='{$_clean['face']}',
                                    tg_email='{$_clean['email']}',
                                    tg_qq='{$_clean['QQ']}',
                                    tg_url='{$_clean['url']}'
                                WHERE
                                    tg_username = '{$_COOKIE['username']}'
                                    ");
       } else {
           _query("UPDATE tg_user SET 
                                    tg_password='{$_clean['password']}',
                                    tg_sex='{$_clean['sex']}',
                                    tg_face='{$_clean['face']}',
                                    tg_email='{$_clean['email']}',
                                    tg_qq='{$_clean['QQ']}',
                                    tg_url='{$_clean['url']}'
                                WHERE
                                    tg_username = '{$_COOKIE['username']}'
                                    ");
       }
   }
    //判断是否修改成功
    if (_affected_row() == 1){
        //关闭数据库
        _close();
        _session_destroy();
        //跳转函数
        _location('恭喜你修改成功','member.php');
    }else{
        _close();
        _session_destroy();
        _location('很遗憾，没有任何数据被修改','member_modify.php');
    }
}

if(isset($_COOKIE['username'])){
    //获取数据
    $_row = _fetch_array("SELECT tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq FROM tg_user WHERE  tg_username ='{$_COOKIE['username']}'");
    if ($_row){
        $_html = array();
        $_html['username'] = $_row['tg_username'];
        $_html['sex'] = $_row['tg_sex'];
        $_html['face'] = $_row['tg_face'];
        $_html['email'] = $_row['tg_email'];
        $_html['url'] = $_row['tg_url'];
        $_html['qq'] = $_row['tg_qq'];
        $_html = _html($_html);

        //性别选择
        if ($_html['sex'] == '男'){
            $_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked" />男 <input type="radio" name="sex" value="女" />女';
        }elseif ($_html['sex'] == '女'){
            $_html['sex_html'] = '<input type="radio" name="sex" value="男"  />男 <input type="radio" name="sex" value="女" checked="checked" />女';
        }

        //头像选择
        $_html['face_html'] = '<select name = "face">';
        foreach (range(1,9) as $_num){
            $_html['face_html'].='<option value="face/m0'.$_num.'.gif">face/m0'.$_num.'.gif</option>';
        }
        foreach (range(10,64) as $_num){
            $_html['face_html'].='<option value="face/m'.$_num.'.gif">face/m'.$_num.'.gif</option>';
        }
        $_html['face_html'].='</select>';
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
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/member_modify.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
    <div id="member">
        <?php require ROOT_PATH.'includes/member.inc.php'?>
        <div id="member_main">
            <h2>会员管理中心</h2>
            <form action="?action=modify" method="post">
            <dl>
                <dd>用户名: <?php echo $_html['username']?></dd>
                <dd>密码:  <input type="text" class="text" name="password" value=""/>(留白表示默认不修改)</dd>
                <dd>性别: <?php echo $_html['sex_html']?></dd>
                <dd>头像: <?php echo $_html['face_html']?></dd>
                <dd>电子邮件: <input type="text" class="text" name="email" value="<?php echo $_html['email']?>"/></dd>
                <dd>主页:  <input type="text" class="text" name="url" value="<?php echo $_html['url']?>"/></dd>
                <dd>QQ：<input type="text" class="text" name="qq" value="<?php echo $_html['qq']?>"/></dd>
                <dd>验 证 码&ensp;：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code" /></dd>
                <dd><input type="submit" class="submit" value="修改资料"/></dd>
            </dl>
            </form>
        </div>
    </div>


    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
