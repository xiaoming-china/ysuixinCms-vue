<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'runtimePath'=>dirname(dirname(__DIR__)).'/web/runtime',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        //     'errorAction' => 'admin-base/error',
        // ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // ‘suffix‘ => ‘.html‘,
            'rules' => [
            ],
        ],
        // 'assetManager' => [
        //     'appendTimestamp' => true,
        //     'basePath' => '@webroot/public/admin',
        //     'baseUrl' => '@web/public/admin'
        // ],
        
    ],
    'params' => $params,
];
