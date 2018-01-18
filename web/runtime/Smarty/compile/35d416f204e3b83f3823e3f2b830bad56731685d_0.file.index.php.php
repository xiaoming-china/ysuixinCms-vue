<?php
/* Smarty version 3.1.31, created on 2018-01-18 14:05:05
  from "F:\xampp\htdocs\vueDemo\web\template\Default\PageList\Index\index.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a60391133c6b2_89212034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d416f204e3b83f3823e3f2b830bad56731685d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\vueDemo\\web\\template\\Default\\PageList\\Index\\index.php',
      1 => 1516255423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.php' => 1,
  ),
),false)) {
function content_5a60391133c6b2_89212034 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title><?php echo '<?=';?>$title<?php echo '?>';?></title>
    <meta name="keywords" content="<?php echo '<?=';?>$keywords<?php echo '?>';?>"/>
    <meta name="description" content="<?php echo '<?=';?>$description<?php echo '?>';?>"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/home/style/basic.css" />
    <link rel="stylesheet" href="/public/home/style/index.css" />
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <?php echo '<script'; ?>
 src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
  </head>
  <body>
<!--导航开始-->
<?php $_smarty_tpl->_subTemplateRender("file:../header.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!--导航结束-->
<div class="cover" style="margin-top: 40px;">
    <div class="row" style="margin: 0;">
        <div class="small-12 medium-12 large-12 columns intro-text">
            <div class="fadeInDown">
                <p>一直相信</p>
                <p>即使一直一个人沉浸在自己的世界里</p>
                <p>最终，也会</p>
                <p>在某个世界</p>
                <p>某个地点</p>
                <p>找到某些自己真正想要的东西</p>
            </div>
            <div class="small-6 medium-6 large-6 columns">
                <a href="/Home/Blog/index.html" class="btnService right fadeIn">进入博客
                </a>
            </div>
            <div class="small-6 medium-6 large-6 columns">
                <a href="/Home/About/index.html" class="btnService left fadeIn">
                关于
                </a>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
<?php echo '<script'; ?>
>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?1873856b1a96138cdd16521be8a1dc50";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
<?php echo '</script'; ?>
><?php }
}
