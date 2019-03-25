<?php

namespace common\modules\menu\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $title
 * @property int $published
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_user_id'], 'required'],
            [['published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title'], 'string', 'max' => 35],
            [['language'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('menu_mod', 'ID'),
            'title' => Yii::t('menu_mod', 'MENU_TITLE'),
            'published' => Yii::t('menu_mod', 'MENU_PUBLISHED'),
            'language' => Yii::t('menu_mod', 'MENU_LANGUAGE'),
            'created_user_id' => Yii::t('menu_mod', 'MENU_CREATED_USER_ID'),
            'created_time' => Yii::t('menu_mod', 'MENU_CREATED_TIME'),
            'modified_user_id' => Yii::t('menu_mod', 'MENU_MODIFIED_USER_ID'),
            'modified_time' => Yii::t('menu_mod', 'MENU_MODIFIED_TIME'),
        ];
    }
}
