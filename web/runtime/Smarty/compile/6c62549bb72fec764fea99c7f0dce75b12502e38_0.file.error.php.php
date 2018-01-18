<?php
/* Smarty version 3.1.31, created on 2018-01-18 13:46:07
  from "F:\xampp\htdocs\vueDemo\vendor\yiisoft\yii2\views\errorHandler\error.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a60349fa32010_54228058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c62549bb72fec764fea99c7f0dce75b12502e38' => 
    array (
      0 => 'F:\\xampp\\htdocs\\vueDemo\\vendor\\yiisoft\\yii2\\views\\errorHandler\\error.php',
      1 => 1513558477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a60349fa32010_54228058 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>/* @var $exception \yii\web\HttpException|\Exception */
/* @var $handler \yii\web\ErrorHandler */
if ($exception instanceof \yii\web\HttpException) {
    $code = $exception->statusCode;
} else {
    $code = $exception->getCode();
}
$name = $handler->getExceptionName($exception);
if ($name === null) {
    $name = 'Error';
}
if ($code) {
    $name .= " (#$code)";
}

if ($exception instanceof \yii\base\UserException) {
    $message = $exception->getMessage();
} else {
    $message = 'An internal server error occurred.';
}

if (method_exists($this, 'beginPage')) {
    $this->beginPage();
}
<?php echo '?>';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo '<?=';?> $handler->htmlEncode($name) <?php echo '?>';?></title>

    <style>
        body {
            font: normal 9pt "Verdana";
            color: #000;
            background: #fff;
        }

        h1 {
            font: normal 18pt "Verdana";
            color: #f00;
            margin-bottom: .5em;
        }

        h2 {
            font: normal 14pt "Verdana";
            color: #800000;
            margin-bottom: .5em;
        }

        h3 {
            font: bold 11pt "Verdana";
        }

        p {
            font: normal 9pt "Verdana";
            color: #000;
        }

        .version {
            color: gray;
            font-size: 8pt;
            border-top: 1px solid #aaa;
            padding-top: 1em;
            margin-bottom: 1em;
        }
    </style>
</head>

<body>
    <h1><?php echo '<?=';?> $handler->htmlEncode($name) <?php echo '?>';?></h1>
    <h2><?php echo '<?=';?> nl2br($handler->htmlEncode($message)) <?php echo '?>';?></h2>
    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
    <div class="version">
        <?php echo '<?=';?> date('Y-m-d H:i:s', time()) <?php echo '?>';?>
    </div>
    <?php echo '<?php
    ';?>if (method_exists($this, 'endBody')) {
        $this->endBody(); // to allow injecting code into body (mostly by Yii Debug Toolbar)
    }
    <?php echo '?>';?>
</body>
</html>
<?php echo '<?php
';?>if (method_exists($this, 'endPage')) {
    $this->endPage();
}
<?php }
}
