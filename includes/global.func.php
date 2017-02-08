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

function _alert_back($_info){
    echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
    exit();
}

/**
 * 生成验证码函数
 * @access public 表示函数对外公开
 * @param int $_width  验证码图片长度 默认75
 * @param int $_height 验证码图片高度 默认25
 * @param int $_rng_code 验证码的位数 默认4位
 * @param bool $_black_flag 验证码图片是否边框 默认否
 */
function _code($_width = 75,$_height = 25, $_rng_code = 4,$_black_flag = false){

    $_nmsg ='';
    for ($i=0;$i<$_rng_code;$i++){
        $_nmsg.=dechex(mt_rand(0,15));//转化成16进制
    }
//保存在session
    $_SESSION['code'] = $_nmsg;


//创建一张图片
    $_img = imagecreatetruecolor($_width,$_height);

//创建白色
    $_white = imagecolorallocate($_img,255,255,255);

//填充
    imagefill($_img,0,0,$_white);//（句柄，起始点x,起始点y,颜色）



//黑色，边框
    if ($_black_flag){
        $_black = imagecolorallocate($_img,0,0,0);
        imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);//(句柄，起始点x,起始点y,终点x，终点y,颜色)
    }

//随机6条斜线
    for ($i=0;$i<6;$i++){
        $_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);//(句柄,起点x，起点y,终点x,终点y,颜色)
    }
//随机雪花
    for ($i=0;$i<100;$i++){
        $_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));//200-255颜色比较淡
        imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);//(句柄，字体（1，2，3，4，5），x坐标，y坐标，字符，颜色)
    }
//输出验证码
    for ($i=0;$i<strlen($_SESSION['code']);$i++){
        imagestring($_img,mt_rand(3,5),$i*$_width/$_rng_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],
            imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
    }
//输出图像
    header('Content-Type:image/png');
    imagepng($_img);

//销毁
    imagedestroy($_img);
}