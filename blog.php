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

//分页模块
_page('SELECT tg_id FROM tg_user',15); //sql取得数据，每页条数

//从数据库提取数据
//我们必须是每次从新读取结果集，而不是每次从新去执行sql
$_result = _query("SELECT tg_id,tg_sex,tg_username,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $_pagenum,$_pagesize");


?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--博友</title>
    <?php
    require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript"  src="js/code.js"></script>
    <script type="text/javascript"  src="js/register.js"></script>
    <script type="text/javascript"  src="js/blog.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
        <div id="blog">
            <h2>博友列表</h2>
            <?php while (!!$_rows = _fetch_array_list($_result)){
                $_html = array();
                $_html['id'] = $_rows['tg_id'];
                $_html['username'] = $_rows['tg_username'];
                $_html['face'] = $_rows['tg_face'];
                $_html['sex'] = $_rows['tg_sex'];
                $_html = _html($_html);

                ?>
            <dl>
                <dd class="user"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
                <dt><img src="<?php echo  $_html['face']?>" alt="炎日"/></dt>
                <dd class="message"><a href="###" name="message" title="<?php echo $_html['id']?>"> 发消息</a></dd>
                <dd class="friend">加为好友</dd>
                <dd class="guest">给他留言</dd>
                <dd class="flower">送花</dd>
            </dl>
            <?php }
            _free($_result);
            _paging(1);//输出分页，1数字分页，2文本分页

            ?>
           

          
        </div>

    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
