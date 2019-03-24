<?php
return [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@moduleArticle' => '@common/modules/article',
    ],
    'bootstrap' => ['category', 'article'],
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
    ],
];
