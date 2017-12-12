<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
//$baseUrl = '/LS/svn_new/';
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name'=>'WFLi',
    //'modules' => [
//        'debug' => 'yii\debug\Module',
//        'allowedIPs' => ['188.27.34.188', '127.0.0.1', '::1']
//    ],
    
    'controllerNamespace' => 'frontend\controllers',
    
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
            'enableCsrfValidation' => false
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            
                '<controller:(site)>/<action:[a-zA-Z0-9-]+>' => '<controller>/<action>',
                '<controller:(site)>/<action:(external-url)>' => '<controller>/<action>',
                '<controller:(external-url)>' => 'site/external-url',
                '<controller:(rate-website)>' => 'site/rate-website',
                
                
                // pretty categories and ids
                
                '<controller:(luminaire)>/<action:[a-zA-Z0-9-]+>/<cat:\d+>' => '<controller>/<action>',
                '<controller:(account)>/<action:[a-zA-Z0-9-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:(account|specialized|luminaire)>/<action:[a-zA-Z0-9-]+>' => '<controller>/<action>',
                
                
                // site actions
//                '<action:[a-zA-Z0-9-]+>' => 'site/<action>',
                
                // site
                
                '/' => 'site/page',
                '<id:[a-zA-Z0-9-]+>' => 'site/page',
                '<id:[a-zA-Z0-9-]+>/<params:[a-zA-Z0-9/-]+>' => 'site/page',
            ]
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => false,
            ],
        ],
        'view' =>array(
            'theme' => array(
                'pathMap' => array('@app/views' => '@root_name/themes/frontend_theme/views'),
                'baseUrl' => '@web/themes/frontend_theme',
                'basePath' => '@app/themes/frontend_theme/views'
            )
        ),
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => __DIR__ . '/../tmp',
        ],
        'user' => [
              'class' => 'yii\web\User', // basic class
              'identityClass' => 'common\models\User', // your admin model
              'enableAutoLogin' => true,
              'identityCookie' => [
                  'name' => '_frontendUser', // unique for frontend
                  'path'=>'/'  // correct path for the frontend app.
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/../themes/frontend_theme/views/emails',
            'htmlLayout' => '@app/../themes/frontend_theme/views/emails/layouts/html',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.office365.com',
                'username' => 'luminaires@wfli.com',
                'password' => 'Bumu9906',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
