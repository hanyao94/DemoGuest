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
require ROOT_PATH.'includes/mysql.func.php';
//执行耗时
define('START_TIME',_runtime());
//$GLOBALS['start_time'] = _runtime();

//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','testguest');

//初始化数据库
_connect(); //连接mysql数据库
_select_db(); //选择指定的数据库
_set_name();  //设置字符集