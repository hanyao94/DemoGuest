<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/10
 * Time: 9:57
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}

/**
 * 连接数据库
 * @access public
 * @return void
 */
function _connect(){
    //创建数据库连接
    global $_conn; //表示全局变量的意思，意图将此变量在函数外也能访问
    if (!$_conn = mysql_connect(DB_HOST,DB_USER,DB_PWD)){
        exit('mysql connect failure');
    }
}

/**
 * 选择一款数据库
 * @return void
 */
function _select_db(){
    if (!mysql_select_db(DB_NAME)){
        exit('not found db');
    }
}

/**
 * 设置字符集
 * @return void
 */
function _set_name(){
    if (!mysql_query('SET NAMES UTF8')){
        exit('charset error');
    }
}

/**
 * 执行sql语句
 * @param $_sql
 * @return resource
 */
function _query($_sql){
    if (!$result = mysql_query($_sql)){
        exit("SQL excute error");
    }
    return $result;
}

/**
 * 返回结果集数组
 * @param $_sql
 * @return array
 */
function _fetch_array($_sql){
    return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/**
 * 判断用户名是否重复
 * @param $_sql
 * @param $_info
 */
function _is_repeat($_sql,$_info){
    if (_fetch_array($_sql)){
        _alert_back($_info);
    }
}

/**
 * 关闭数据库
 */
function _close(){
    if (!mysql_close()){
        exit("mysql_close error");
    }
}