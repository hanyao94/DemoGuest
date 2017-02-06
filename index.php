<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/6
 * Time: 16:01
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--首页</title>
    <link rel="stylesheet" type="text/css" href="styles/1/basic.css"/>
    <link rel="stylesheet" type="text/css" href="styles/1/index.css"/>
</head>

<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>

    <div id="list">
        <h2>帖子列表</h2>
    </div>

    <div id="user">
        <h2>新进会员</h2>
    </div>

    <div id="pics">
        <h2>最新图片</h2>
    </div>
    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>