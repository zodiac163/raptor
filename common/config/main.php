<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@moduleArticle' => '@common/modules/article',
    ],
    'bootstrap' => ['category', 'article', 'menu', 'product'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'cache' => false,
            'rules' => [
                'cat/<category:.+>' => 'article/category/list',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<module>/<controller>/<action>',
                ['class' => 'frontend\components\Pages\PagesUrlRule'],
                ['class' => 'frontend\components\Pages\StrictParseRequest'],
                'article/<id:\d+>' => 'article/default/view',
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'forceTranslation' => true,
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'forceTranslation' => true,
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'forceTranslation' => true,
                ],
            ],
        ],
    ],
    'modules' => [
        'category' => [
            'class' => 'common\modules\category\Module',
        ],
        'article' => [
            'class' => 'common\modules\article\Module',
        ],
        'menu' => [
            'class' => 'common\modules\menu\Module',
        ],
        
        'product' => [
            'class' => 'common\modules\product\Module',
        ],
    ],
];
