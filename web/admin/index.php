<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('Template',dirname(__DIR__).'/template/');//模板存放路径
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../../backend/config/bootstrap.php');
require(__DIR__ . '/../../common/function.php');


$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../../backend/config/main.php'),
    require(__DIR__ . '/../../backend/config/main-local.php')
);
$application = new yii\web\Application($config);  
$application->defaultRoute='index/index';
$application->run();  


