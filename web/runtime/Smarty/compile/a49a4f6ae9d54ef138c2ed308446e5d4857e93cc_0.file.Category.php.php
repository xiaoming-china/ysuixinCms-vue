<?php
/* Smarty version 3.1.31, created on 2018-01-18 15:42:42
  from "F:\xampp\htdocs\vueDemo\web\template\Default\PageList\Category\Category.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a604ff2d954f1_43465996',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a49a4f6ae9d54ef138c2ed308446e5d4857e93cc' => 
    array (
      0 => 'F:\\xampp\\htdocs\\vueDemo\\web\\template\\Default\\PageList\\Category\\Category.php',
      1 => 1516261199,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.php' => 1,
    'file:../footer.php' => 1,
  ),
),false)) {
function content_5a604ff2d954f1_43465996 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_block_contentList')) require_once 'F:\\xampp\\htdocs\\vueDemo\\common\\lib\\smarty\\block.contentList.php';
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
"/>
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/home/style/basic.css" />
    <link rel="stylesheet" href="/public/home/style/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/public/home/style/animate.min.css">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <?php echo '<script'; ?>
 src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="http://cdn.bootcss.com/jquery.nicescroll/3.6.0/jquery.nicescroll.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/home/js/basic.js"><?php echo '</script'; ?>
>
  </head>
  <body>
<!--导航开始-->
<?php $_smarty_tpl->_subTemplateRender("file:../header.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!--导航结束-->
    <div class="container main-content" id="articleList">
      <div class="row">
            <div class="col-md-12">
              <div class="blog-right-box">
              <!--内容列表开始-->
              <?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('contentList', array('num'=>"2"));
$_block_repeat=true;
echo smarty_block_contentList(array('num'=>"2"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
                  <div class="blog-item">
                    <div class="blog-item-header">
                      <h4>
                        <a href = <?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a>
                      </h4>
                      <p class="header-info"> 
                        <span>time：<em><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['v']->value['created_at']);?>
</em></span>
                        <span>view：<em><?php echo $_smarty_tpl->tpl_vars['v']->value['view'];?>
</em></span>
                      </p>
                    </div>
                    <div class="blog-item-content">
                        <div class="row">
                          <div class="col-md-12 blog-content">
                          <img src="<?php echo $_smarty_tpl->tpl_vars['v']->value['thumb'];?>
" class=" pull-left" width="300px" height="200px">
                           <p><?php echo $_smarty_tpl->tpl_vars['v']->value['desc'];?>
</p>
                          </div>
                        </div>
                    </div>
                  </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
 
              <?php $_block_repeat=false;
echo smarty_block_contentList(array('num'=>"2"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

              <!--内容列表结束-->
              <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

              </div>
            </div>
        </div>
    </div>
    <?php $_smarty_tpl->_subTemplateRender("file:../footer.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
   


<?php }
}
