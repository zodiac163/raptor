<?php

namespace common\modules\article\models;

use Yii;
use yii\helpers\Url;

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
 * @property int $published
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
            [['title', 'path', 'introtext', 'fulltext', 'ordering', 'created_user_id', 'published'], 'required'],
            [['fulltext', 'images', 'metadata'], 'string'],
            [['cat_id', 'featured', 'ordering', 'hits', 'created_user_id', 'modified_user_id', 'published'], 'integer'],
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
            'title' => Yii::t('art_mod', 'ARTICLE_TITLE'),
            'path' => Yii::t('art_mod', 'ARTICLE_PATH'),
            'introtext' => Yii::t('art_mod', 'ARTICLE_INTROTEXT'),
            'fulltext' => Yii::t('art_mod', 'ARTICLE_FULLTEXT'),
            'cat_id' => Yii::t('art_mod', 'ARTICLE_CAT_ID'),
            'images' => Yii::t('art_mod', 'ARTICLE_IMAGES'),
            'featured' => Yii::t('art_mod', 'ARTICLE_FEATURED'),
            'ordering' => Yii::t('art_mod', 'ARTICLE_ORDERING'),
            'published' => Yii::t('art_mod', 'ARTICLE_PUBLISHED'),
            'hits' => Yii::t('art_mod', 'ARTICLE_HITS'),
            'metadata' => Yii::t('art_mod', 'ARTICLE_METADATA'),
            'language' => Yii::t('art_mod', 'ARTICLE_LANGUAGE'),
            'created_user_id' => Yii::t('art_mod', 'ARTICLE_CREATED_USER_ID'),
            'created_time' => Yii::t('art_mod', 'ARTICLE_CREATED_TIME'),
            'modified_user_id' => Yii::t('art_mod', 'ARTICLE_MODIFIED_USER_ID'),
            'modified_time' => Yii::t('art_mod', 'ARTICLE_MODIFIED_TIME'),
        ];
    }

    public function imagePreparation() {
        $initialPreview = [];
        $initialPreviewConfig = [];

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $images = json_decode($this->images);
        foreach ($images->urls as $image) {
            $initialPreview[] = $protocol . Yii::$app->params['fileStore'] . $image->url;
            $image->key = $image->url;
            $image->url = Url::to(['/article/default/removefile']);
            $initialPreviewConfig[] = $image;
        }

        return [
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ];
    }
}
