<?php
/**
 * Created by PhpStorm.
 * User: Seven
 * Date: 2017/2/7
 * Time: 16:22
 */
//防止恶意调用
if (!defined('IN_TG')){ //防止恶意调用
    exit('Access Denfied');
}
//防止非HTML页面的调用
if (!defined('SCRIPT')){
    exit('Script Error!');
}

?>
<link rel="stylesheet" type="text/css" href="styles/1/basic.css"/>
<link rel="stylesheet" type="text/css" href="styles/1/<?php echo SCRIPT ?>.css"/>
