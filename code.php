<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/8
 * Time: 10:55
 */
session_start();//开启session
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//运行验证码函数
//该函数有四个参数 (验证码图片长度 默认75，验证码图片高度 默认25，验证码位数 默认4位，验证码图片是否边框 默认false)
//如果要6位，长度 125，如果要8位，长度175 以此类推，如果要边框true,不用则默认false
//可以通过数据库的方法，来设置验证码的各种属性
_code();