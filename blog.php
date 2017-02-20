<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/16
 * Time: 17:27
 */
//防止恶意调用,用来授权调用includes里面的文件
define('IN_TG',true);
// 公共文件
require dirname(__FILE__).'/includes/common.inc.php'; //转换成硬路径，速度快
//css样式引入，证明是本页
define('SCRIPT','blog');

//分页模块
$_page = @$_GET['page'];//第几页
$_page = (empty($_page)||($_page<0)||!is_numeric($_page))?1:intval($_page);
$_pagesize = 10; //每页条数
//首先要得到所有数据的总和
$_num = _num_rows(_query("SELECT tg_id FROM tg_user")); //总条数
$_pageabsolute = $_num==0?1:ceil($_num / $_pagesize);//向上取整，总页数
if ($_page>$_pageabsolute) $_page=$_pageabsolute; //页码比总页数大
$_pagenum = ($_page-1) * $_pagesize; //page偏移量，从第几条开始 容错处理，不能为空，负数，非数字，小数


//从数据库提取数据
//我们必须是每次从新读取结果集，而不是每次从新去执行sql
$_result = _query("SELECT tg_sex,tg_username,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $_pagenum,$_pagesize");


?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html"; charset="utf-8"/>
    <title>多用户留言系统--注册</title>
    <?php
    require ROOT_PATH.'includes/title.inc.php'; //包含
    ?>
    <script type="text/javascript"  src="js/code.js"></script>
    <script type="text/javascript"  src="js/register.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH.'includes/header.inc.php'; //包含
    ?>
        <div id="blog">
            <h2>博友列表</h2>
            <?php while (!!$_rows = _fetch_array_list($_result)){ ?>
            <dl>
                <dd class="user"><?php echo $_rows['tg_username']?>(<?php echo $_rows['tg_sex']?>)</dd>
                <dt><img src="<?php echo $_rows['tg_face']?>" alt="炎日"/></dt>
                <dd class="message">发消息</dd>
                <dd class="friend">加为好友</dd>
                <dd class="guest">给他留言</dd>
                <dd class="flower">送花</dd>
            </dl>
            <?php } ?>
            <div id="page_num">
                <ul>
                    <?php for($i=0;$i<$_pageabsolute;$i++){
                        if ($_page == ($i+1)){
                            echo '<li><a href="blog.php?page='.($i+1).'" class = "selected">'.($i+1).'</a></li>';
                        }else{
                            echo '<li><a href="blog.php?page='.($i+1).'">'.($i+1).'</a></li>';
                        }
                    }?>
                </ul>
            </div>

            <div id="page_text">
                <ul>
                    <li><?php echo $_page?>/<?php echo $_pageabsolute ?>页|</li>
                    <li>共有<strong><?php echo $_num?></strong>个会员</li>
                    <?php
                        if ($_page == 1){
                            echo '<li>首页|</li>';
                            echo '<li>上一页|</li>';
                        }else{
                            echo '<li><a href="'.SCRIPT.'.php">首页|</a></li>';
                            echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页|</a></li>';

                        }
                        if ($_page == $_pageabsolute){
                            echo '<li>下一页|</li>';
                            echo '<li>尾页|</li>';
                        }else{
                            echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页|</a></li>';
                            echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页|</a></li>';
                        }


                    ?>
                </ul>
            </div>
        </div>

    <?php
        require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>
