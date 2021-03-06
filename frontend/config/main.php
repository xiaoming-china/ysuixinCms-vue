<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'viewPath'=>dirname(dirname(__DIR__)).'/web/template',
    'runtimePath'=>dirname(dirname(__DIR__)).'/web/runtime',
    'components' => [
        'view' => [
            'renderers' => [
                'php' => [
                    'class' => 'yii\smarty\ViewRenderer',
                    'cachePath' => dirname(dirname(__DIR__)).'/web/runtime/Smarty/cache',
                    'options' => [
                        'left_delimiter'=>"{{",
                        'right_delimiter'=>"}}",
                        'plugins_dir' => [dirname(dirname(__DIR__)).'/common/lib/smarty'],
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // 'errorHandler' => [
        //     'errorAction' => 'site/error',
        // ],
        'assetManager' => [
            'appendTimestamp' => true,
            'basePath' => '@webroot/public',
            'baseUrl' => '@web/public'
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
