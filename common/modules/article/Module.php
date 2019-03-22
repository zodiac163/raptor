<?php

namespace common\modules\article;

use Yii;

/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\article\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['art_mod'] = [ // <-- put translation group name
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'basePath' => __DIR__ . '/messages',
            'forceTranslation' => true,
        ];
    }
}
