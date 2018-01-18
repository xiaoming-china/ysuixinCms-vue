<?php
/* Smarty version 3.1.31, created on 2018-01-18 14:08:56
  from "F:\xampp\htdocs\vueDemo\web\template\Default\PageList\header.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a6039f8de9888_29980341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f07bdfc209279f95a24c10bb21eb042a20b3d46c' => 
    array (
      0 => 'F:\\xampp\\htdocs\\vueDemo\\web\\template\\Default\\PageList\\header.php',
      1 => 1516255720,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a6039f8de9888_29980341 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_block_nav')) require_once 'F:\\xampp\\htdocs\\vueDemo\\common\\lib\\smarty\\block.nav.php';
?>
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
<!--导航结束--><?php }
}
