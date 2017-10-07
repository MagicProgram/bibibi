<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require(dirname(__DIR__) . "/config/db.php"),

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<city:(ekb|Ростов)>' => 'site/index',
                // 'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
                // 'view-advert/<id:\d+>' => 'main/main/view-advert',
                // 'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'
            ]
        ],
    ],
];
