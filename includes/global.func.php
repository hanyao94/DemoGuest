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

/**
 * 验证码错误弹窗
 * @param $_info
 */
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
    exit();
}

/**
 * 注册成功，跳转
 * @param $_info
 * @param $_url
 */
function _location($_info,$_url){
    if (!empty($_info)){

        echo "<script type='text/javascript'>alert('$_info.');location.href='$_url';</script>";
        exit();
    }else{
        header('Location:'.$_url);
    }
}
/**
 * 生成唯一标识符
 * @return string
 */
function _sha1_string(){
    return sha1(uniqid(rand(),true));
}

/**
 * 转义函数，如果自动转义有开则不在手动转义
 * @param $_string
 * @return string
 */
function _mysql_string($_string){
    //如果get_magic_quotes_gpc()这个函数是开启状态，则不需要转义
    if (!GPC){
       return mysql_escape_string($_string);
    }
    return $_string;
}


/**
 * 验证码比对
 * @param $_first_code
 * @param $_end_code
 */
function _check_code($_first_code,$_end_code){
    if ($_first_code != $_end_code){
        _alert_back('验证码不正确');
    }
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

/**
 * 判断登录状态
 */
function _login_state(){
    if (isset($_COOKIE['username'])){
        _alert_back("登录状态无法进行本操作");
    }
}

/**
 * 判断唯一标识符是否异常
 * @param $_mysql_uniqid
 * @param $_cookie_uniqid
 */
function _uniqid($_mysql_uniqid,$_cookie_uniqid){
    if ($_mysql_uniqid != $_cookie_uniqid ){
        _alert_back('唯一标识符异常');
    }
}

/**
 * 过滤html字符
 * 如果是数组就按照数组的方式过滤；如果是字符串就按照字符串的方式过滤
 * @param $_string 字符串或者数组
 * @return string
 *
 */
function _html($_string){
    if (is_array($_string)){
        foreach ($_string as $_key =>$_value){
            $_string[$_key] = _html($_value); //这里采用了递归
        }
    }else{
        $_string = htmlspecialchars($_string);
    }
    return $_string;
}

/**分页数据函数
 * @param $_sql 执行的sql语句
 * @param $_size 每页条数
 * @return 分页的数据 全局
 */
function _page($_sql,$_size){
    //将数据用全局变量取出，以便页面可以调用
    global $_page,$_pagesize,$_num,$_pageabsolute,$_pagenum;
    $_page = @$_GET['page'];//第几页
    $_page = (empty($_page)||($_page<0)||!is_numeric($_page))?1:intval($_page);
    $_pagesize = $_size; //每页条数
    //首先要得到所有数据的总和
    $_num = _num_rows(_query($_sql)); //总条数
    $_pageabsolute = $_num==0?1:ceil($_num / $_pagesize);//向上取整，总页数
    if ($_page>$_pageabsolute) $_page=$_pageabsolute; //页码比总页数大
    $_pagenum = ($_page-1) * $_pagesize; //page偏移量，从第几条开始 容错处理，不能为空，负数，非数字，小数

}


/**
 * 分页函数
 * @param $_type 类型 1数字分页，2文本分页
 * @return 分页
 */
function _paging($_type){
    global $_pageabsolute,$_page,$_num;
    if ($_type == 1){
        echo '<div id="page_num">';
        echo '<ul>';
               for($i=0;$i<$_pageabsolute;$i++){
                if ($_page == ($i+1)){
                    echo '<li><a href="blog.php?page='.($i+1).'" class = "selected">'.($i+1).'</a></li>';
                }else{
                    echo '<li><a href="blog.php?page='.($i+1).'">'.($i+1).'</a></li>';
                }
            }
        echo '</ul>';
        echo '</div>';
    }elseif ($_type == 2){
           echo '<div id="page_text">';
           echo  '<ul>';
                    echo '<li> '.$_page.' / '.$_pageabsolute.' 页|</li>';
                    echo '<li>共有<strong>'.$_num.'</strong>个会员|</li>';

                    if ($_page == 1){
                        echo '<li>首页|</li>';
                        echo '<li>上一页|</li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php">首页|</a></li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页|</a></li>';

                    }
                    if ($_page == $_pageabsolute){
                        echo '<li>下一页|</li>';
                        echo '<li>尾页</li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页|</a></li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页</a></li>';
                    }

                echo '</ul>';
            echo '</div>';
    }
}

/**
 * 清除session
 */
function _session_destroy(){
    session_destroy();
}

/**
 * 删除cookie
 */
function _unsetcookies(){
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    _session_destroy();
    _location(null,'index.php');
}

