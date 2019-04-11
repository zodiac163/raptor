<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $sys_title
 * @property int $sys_state
 * @property string $sys_slogan
 * @property string $sys_description
 * @property string $sys_logo
 * @property string $sys_footer
 * @property string $adm_mail
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sys_title'], 'required'],
            [['sys_state'], 'integer'],
            [['sys_title', 'adm_mail'], 'string', 'max' => 99],
            [['sys_slogan'], 'string', 'max' => 255],
            [['sys_description', 'sys_logo', 'sys_footer', 'seo_description', 'seo_keywords'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_title' => Yii::t('app', 'SETTINGS_SYS_TITLE'),
            'sys_state' => Yii::t('app', 'SETTINGS_SYS_STATE'),
            'sys_slogan' => Yii::t('app', 'SETTINGS_SYS_SLOGAN'),
            'sys_description' => Yii::t('app', 'SETTINGS_SYS_DESCRIPTION'),
            'sys_logo' => Yii::t('app', 'SETTINGS_SYS_LOGO'),
            'sys_footer' => Yii::t('app', 'SETTINGS_SYS_FOOTER'),
            'adm_mail' => Yii::t('app', 'SETTINGS_ADM_MAIL'),
            'seo_description' => Yii::t('app', 'SETTINGS_SEO_DESCRIPTION'),
            'seo_keywords' => Yii::t('app', 'SETTINGS_SEO_KEYWORDS'),
        ];
    }
}
