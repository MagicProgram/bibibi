<?php



return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'components' => [
        // 'formatter' => [
        //        'class' => 'yii\i18n\Formatter',
        //        'defaultTimeZone' => 'Europe/Moscow',
        //        'timeZone' => 'GMT+3',
        //        'dateFormat' => 'd MMMM yyyy',
        //        'datetimeFormat' => 'd-M-Y H:i:s',
        //        'timeFormat' => 'H:i:s', 
        // ],
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
                '<city:(ekb|moscow|rostov|spb)>/for-kids' => 'kids/schools-for-kids',
                '<city:(ekb|moscow|rostov|spb)>/types/<type:[a-zA-Z0-9-]+>/for-kids' => 'kids/type-for-kids',
                // 'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
                // 'view-advert/<id:\d+>' => 'main/main/view-advert',
                // 'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'
            ]
        ],
    ],
];
