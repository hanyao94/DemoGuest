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
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

if (PHP_VERSION < '4.1.0'){
    exit("Version is to Low！");
}
require ROOT_PATH.'includes/global.func.php';
//执行耗时
define('START_TIME',_runtime());
//$GLOBALS['start_time'] = _runtime();
?>