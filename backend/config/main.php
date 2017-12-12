<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name'=> 'Luminaire Selector',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'view' =>array(
            'theme' => array(
                'pathMap' => array('@app/views' => '@root_name/themes/backend_theme/views'),
                'baseUrl' => '../../themes/backend_theme/views',
                'basePath' => '../../themes/backend_theme/views'
            )
        ),
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => __DIR__ . '/../tmp',
        ],
        'user' => [
              'class' => 'yii\web\User', // basic class
              'identityClass' => 'common\models\Admin', // your admin model
              'enableAutoLogin' => true,
              'identityCookie' => [
                  'name' => '_backendUser', // unique for frontend
                  'path'=>'/ls_new/frontend'  // correct path for the frontend app.
              ]
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
        'request' => [
            'enableCsrfValidation'=>false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
    ],
    'modules'=>[
        'importcsv' => [
            'class' => 'backend\modules\importcsv\ImportcsvModule',
        ],
            'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
            // other module settings
            ],
            'gridview'=> [
            'class'=>'\kartik\grid\Module',
            // other module settings
            ],
    ],
    'params' => $params,
];
