<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/6
 * Time: 16:06
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}
?>
<div id="footer">
    <p>本程序执行耗时为<?php echo round((_runtime() - START_TIME),5) ?>秒</p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<span>瓢城web俱乐部</span>提供 源代码可以任意修改和发布</p>
</div>
