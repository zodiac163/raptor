<?php

namespace common\modules\menu\models;

use Yii;

/**
 * This is the model class for table "menu_links".
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string $link
 * @property int $parent_id
 * @property int $published
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 */
class MenuLinks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id', 'title', 'link', 'created_user_id'], 'required'],
            [['menu_id', 'parent_id', 'published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title'], 'string', 'max' => 35],
            [['link'], 'string', 'max' => 1024],
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
            'menu_id' => Yii::t('menu_mod', 'MENU_LINK_MENU_ID'),
            'title' => Yii::t('menu_mod', 'MENU_TITLE'),
            'link' => Yii::t('menu_mod', 'MENU_LINK_LINK'),
            'parent_id' => Yii::t('menu_mod', 'MENU_LINK_PARENT'),
            'published' => Yii::t('menu_mod', 'MENU_PUBLISHED'),
            'language' => Yii::t('menu_mod', 'MENU_LANGUAGE'),
            'created_user_id' => Yii::t('menu_mod', 'MENU_CREATED_USER_ID'),
            'created_time' => Yii::t('menu_mod', 'MENU_CREATED_TIME'),
            'modified_user_id' => Yii::t('menu_mod', 'MENU_MODIFIED_USER_ID'),
            'modified_time' => Yii::t('menu_mod', 'MENU_MODIFIED_TIME'),
        ];
    }
}
