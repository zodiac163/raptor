<?php

namespace common\modules\article\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $introtext Анонс
 * @property string $fulltext Полный текст
 * @property int $cat_id
 * @property string $images Набор картинок для превью
 * @property int $featured Избранное
 * @property int $ordering Сортировка
 * @property int $hits Коичество показов статьи
 * @property string $metadata
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'path', 'introtext', 'fulltext', 'ordering', 'created_user_id'], 'required'],
            [['fulltext', 'images', 'metadata'], 'string'],
            [['cat_id', 'featured', 'ordering', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 400],
            [['introtext'], 'string', 'max' => 1000],
            [['language'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art_mod', 'ID'),
            'title' => Yii::t('art_mod', 'Title'),
            'path' => Yii::t('art_mod', 'Path'),
            'introtext' => Yii::t('art_mod', 'Introtext'),
            'fulltext' => Yii::t('art_mod', 'Fulltext'),
            'cat_id' => Yii::t('art_mod', 'Cat ID'),
            'images' => Yii::t('art_mod', 'Images'),
            'featured' => Yii::t('art_mod', 'Featured'),
            'ordering' => Yii::t('art_mod', 'Ordering'),
            'hits' => Yii::t('art_mod', 'Hits'),
            'metadata' => Yii::t('art_mod', 'Metadata'),
            'language' => Yii::t('art_mod', 'Language'),
            'created_user_id' => Yii::t('art_mod', 'Created User ID'),
            'created_time' => Yii::t('art_mod', 'Created Time'),
            'modified_user_id' => Yii::t('art_mod', 'Modified User ID'),
            'modified_time' => Yii::t('art_mod', 'Modified Time'),
        ];
    }
}
