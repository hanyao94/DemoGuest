<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/16
 * Time: 17:27
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','blog');
//从数据库提取数据
//我们必须是每次从新读取结果集，而不是每次从新去执行sql
$_result = mysql_query("SELECT tg_sex,tg_username,tg_face FROM tg_user ORDER BY tg_reg_time DESC");


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
    <script type="text/javascript"  src="js/code.js"></script>
    <script type="text/javascript"  src="js/register.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
        <div id="blog">
            <h2>博友列表</h2>
            <?php while (!!$_rows = _fetch_array_list($_result)){ ?>
            <dl>
                <dd class="user"><?php echo $_rows['tg_username']?>(<?php echo $_rows['tg_sex']?>)</dd>
                <dt><img src="<?php echo $_rows['tg_face']?>" alt="炎日"/></dt>
                <dd class="message">发消息</dd>
                <dd class="friend">加为好友</dd>
                <dd class="guest">给他留言</dd>
                <dd class="flower">送花</dd>
            </dl>
            <?php } ?>
        </div>

    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>