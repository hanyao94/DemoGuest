<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/8
 * Time: 19:53
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}

if (!function_exists('_alert_back')){
    exit('_alert_back()函数不存在，请检查');
}

/**
 * 过滤用户名
 * @param $_string 受污染的用户名
 * @param $_min_num 最小位数
 * @param $_max_num 最大位数
 * @return string   过滤后的的用户名
 */
function _check_username($_string,$_min_num,$_max_num){
    //去掉两边的空格
    $_string = trim($_string);

    //长度小于两位或者大于20位
    if (mb_strlen($_string,'utf-8')<$_min_num||mb_strlen($_string,'utf-8')>$_max_num){
        _alert_back('长度不得小于'.$_min_num.'或者大于'.$_max_num.'位');
    }

    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \   ]/';//中括弧匹配任意
    if (preg_match($_char_pattern,$_string)){
        _alert_back('用户名不得包含敏感字符');
    }

    //限制敏感用户
    $_mg[0] = '李炎恢';
    $_mg[1] = '胡心鹏';
    $_mg[2] = '吴祁';
    //告诉用户，有哪些不能够注册
    $_mg_string = '';
    foreach ($_mg as $value){
        $_mg_string.='['.$value.']'.'\n';
    }

    //这里采用绝对匹配
    if (in_array($_string,$_mg)){
        _alert_back($_mg_string.'以上敏感用户名不得注册');
    }
    //将用户名转义输出
    //return mysql_real_escape_string($_string);//有问题
    return mysql_escape_string($_string);
}