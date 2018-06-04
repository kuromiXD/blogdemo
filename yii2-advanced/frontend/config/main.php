<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'post/index',
    'language' => 'zh-CN',
    'components' => [
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/detail",
                "posts"=>"post/index",
            ],
        ],
        'httpCache' => [
            'class' => 'yii\filters\HttpCache',
            'only' => ['detail'],
            'lastModified' => function($action,$params){
                $q=new \yii\db\Query();
                return $q->from('post')->max('update_time');
            },
            'etagSeed' => function($action,$params){
                $post=$this->findModel(Yii::$app->request->get('id'));
                return serialize([$post->title,$post->content]);
            },
        ],
        
    ],
    'params' => $params,
];