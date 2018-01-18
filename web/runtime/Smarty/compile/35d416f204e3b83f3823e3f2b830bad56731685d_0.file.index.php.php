<?php
/* Smarty version 3.1.31, created on 2018-01-18 13:49:05
  from "F:\xampp\htdocs\vueDemo\web\template\Default\PageList\Index\index.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a603551771600_42949549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d416f204e3b83f3823e3f2b830bad56731685d' => 
    array (
      0 => 'F:\\xampp\\htdocs\\vueDemo\\web\\template\\Default\\PageList\\Index\\index.php',
      1 => 1516254524,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a603551771600_42949549 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_block_nav')) require_once 'F:\\xampp\\htdocs\\vueDemo\\common\\lib\\smarty\\block.nav.php';
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
<div class="nav-box">
  <div class="container">
      <nav class="navbar nav-nav-box navbar-default navbar-fixed-top nav-top" role="navigation">
    <div class="container">
       <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#nav-sub">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">意随心</a>
    </div>
    <div class="collapse navbar-collapse" id="nav-sub">
        <ul class="nav navbar-nav navbar-right">
            <li class="active">
              <a href="#">首页</a>
            </li>
            <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('nav', array());
$_block_repeat=true;
echo smarty_block_nav(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
                    <?php if (count($_smarty_tpl->tpl_vars['v']->value['children']) != 0) {?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                              <?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>

                              <b class="caret"></b> 
                            </a> 
                            <ul class="dropdown-menu">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['children'], 'vv');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->value) {
?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['vv']->value['nav_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['vv']->value['name'];?>
</a></li> 
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
 
                            </ul> 
                        </li>
                    <?php } else { ?>
                        <li>
                          <a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a>
                        </li>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
  
            <?php $_block_repeat=false;
echo smarty_block_nav(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

        </ul>
    </div>
    </div>
  </nav>
  </div>
</div>
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
