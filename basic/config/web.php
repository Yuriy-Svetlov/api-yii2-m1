<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';





$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'api_model_1_default-v1' => [
            //'class' => 'app\modules\api\v1\IndexModule',
            'class' => 'app\modules\api_model_1_default\v1\IndexModule',
        ], 
        'api_model_2-v1' => [
            'class' => 'app\modules\api_model_2\v1\IndexModule',
        ],         
    ],      
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'a3N6wCJCX-M5Z4s4WXGDKl2PqX_1agHm',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]             
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' =>  true,
            'rules' => [
                'GET /' => 'site/index',
                'GET /reactjs' => 'site/reactjs',
                'GET /about' => 'site/about',

                // =========================================
                // API-Model - 1
                // =========================================
                // 'GET,HEAD api/model_1/users/<id:[0-9]+>' => 'api_model_1_default-v1/user/view',
                // 'GET,HEAD api/model_1/users' => 'api_model_1_default-v1/user/index',
                /*
                    GET /users: list all users page by page;
                    HEAD /users: show the overview information of user listing;
                    POST /users: create a new user;
                    GET /users/123: return the details of the user 123;
                    HEAD /users/123: show the overview information of user 123;
                    PATCH /users/123 and PUT /users/123: update the user 123;
                    DELETE /users/123: delete the user 123;
                    OPTIONS /users: show the supported verbs regarding endpoint /users;
                    OPTIONS /users/123: show the supported verbs regarding endpoint /users/123                
                 */
                [
                    /*
                    'patterns' => [
                        'GET,HEAD' => 'index',
                        'GET,HEAD {id}' => 'view',
                    ],  
                    'tokens' => [
                        '{id}' => '<id:[0-9]+>'
                    ], 
                    */                            
                    'class' => 'yii\rest\UrlRule', 
                    //'controller' => 'api/user',
                    //'controller' => 'modules\api\v1\controllers\user',
                    'controller' => ['api/model_1/users' => 'api_model_1_default-v1/user'],
                    //'except' => ['delete'],
                    //'only' => ['delete'],
                ],
                [
                          
                    'class' => 'yii\rest\UrlRule', 
                    //'controller' => 'api/user',
                    //'controller' => 'modules\api\v1\controllers\user',
                    'controller' => ['api/model_2/users' => 'api_model_2-v1/user'],
                    //'except' => ['delete'],
                    //'only' => ['delete'],
                ]
                // =========================================
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
