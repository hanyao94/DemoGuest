<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/16
 * Time: 17:10
 */
session_start();
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
_unsetcookies();