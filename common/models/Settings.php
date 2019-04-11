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
            'sys_title' => Yii::t('app', 'Sys Title'),
            'sys_state' => Yii::t('app', 'Sys State'),
            'sys_slogan' => Yii::t('app', 'Sys Slogan'),
            'sys_description' => Yii::t('app', 'Sys Description'),
            'sys_logo' => Yii::t('app', 'Sys Logo'),
            'sys_footer' => Yii::t('app', 'Sys Footer'),
            'adm_mail' => Yii::t('app', 'Adm Mail'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'seo_keywords' => Yii::t('app', 'Seo Keywords'),
        ];
    }
}
