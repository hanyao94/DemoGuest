<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/6
 * Time: 16:54
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}

//设置字符集编码
header('Content-type:text/html;charset=utf-8');

//转换硬路径常量
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

//创建一个自动转义常量
define('GPC',get_magic_quotes_gpc());

if (PHP_VERSION < '4.1.0'){
    exit("Version is to Low！");
}
require ROOT_PATH.'includes/global.func.php';
//执行耗时
define('START_TIME',_runtime());
//$GLOBALS['start_time'] = _runtime();

//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','testguest');

//创建数据库连接
$_conn = mysql_connect(DB_HOST,DB_USER,DB_PWD)or die('数据库连接失败');

//选择一款数据库
mysql_select_db(DB_NAME) or die('指定数据库不存在');

//选择字符集
mysql_query('SET NAMES UTF8') or die('字符集错误');
?>