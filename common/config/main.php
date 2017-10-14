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
                '<city:(ekb|moscow|rostov|spb)>' => 'site/schools',
                '<city:(ekb|moscow|rostov|spb)>/<id:\d+>-<name:[a-zA-Z0-9-]+>' => 'site/view',
                '<city:(ekb|moscow|rostov|spb|site)>/types' => 'site/all-types',
                '<city:(ekb|moscow|rostov|spb)>/types/<type:[a-zA-Z0-9-]+>' => 'site/types',
                // 'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
                // 'view-advert/<id:\d+>' => 'main/main/view-advert',
                // 'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'
            ]
        ],
    ],
];
