<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/8
 * Time: 10:55
 */
session_start();//开启session

//创建随机码
$_rng_code = 4;

$_nmsg ='';
for ($i=0;$i<$_rng_code;$i++){
    $_nmsg.=dechex(mt_rand(0,15));//转化成16进制
}
//保存在session
$_SESSION['code'] = $_nmsg;

//长和高
$_width = 75;
$_height = 25;

//创建一张图片
$_img = imagecreatetruecolor($_width,$_height);

//创建白色
$_white = imagecolorallocate($_img,255,255,255);

//填充
imagefill($_img,0,0,$_white);//（句柄，起始点x,起始点y,颜色）

$_black_flag = false;

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