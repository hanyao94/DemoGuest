<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/7
 * Time: 16:38
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//定义css,证明是本页
define('SCRIPT','face');
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--头像选择</title>
    <?php
        require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
    <div id="face">
        <h3>选择图片</h3>
        <dl>
            <?php foreach (range(1,9) as $num ){?>
            <dd><img src="face/m0<?php echo $num?>.gif" alt="face/m0<?php echo $num?>.gif" title="头像<?php echo $num?>" /></dd>
            <?php }?>
        </dl>
        <dl>
            <?php foreach (range(10,64) as $num ){?>
                <dd><img src="face/m<?php echo $num?>.gif" alt="face/m<?php echo $num?>.gif" title="头像<?php echo $num?>" /></dd>
            <?php }?>
        </dl>
    </div>
</body>
</html>
