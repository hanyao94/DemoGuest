<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/6
 * Time: 17:30
 */
/**
 * 获取执行耗时的函数
 * @access public 表示函数对外公开
 * @return float
 */
function _runtime(){
    $_mtime = explode(' ',microtime());
    return $_mtime[1] + $_mtime[0];
}