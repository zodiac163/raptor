<?php

namespace common\modules\article\models;

use common\models\Route;
use dastanaron\translit\Translit;
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
        if ($images && isset($images->urls)) {
            foreach ($images->urls as $image) {
                $initialPreview[] = $protocol . Yii::$app->params['fileStore'] . $image->url;
                $image->key = $image->url;
                $image->url = Url::to(['/article/default/removefile']);
                $initialPreviewConfig[] = $image;
            }
        }

        return [
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ];
    }

    public function setRoute() {
        if ($this->path === '') {
            $translit = new Translit();
            $this->path = $translit->translit($this->title, true, 'ru-en');
            $this->save();
        }

        if (!Route::findAlias($this->path)) {
            //Перед созданием нового алиаса надо проверить нет для этой статьи алиаса с другим путем
            //На тот случай, если у материала поменялся path
            if (!Route::updateByModel('article', $this->id, $this->path)) {
                //Если алиаса еще не создавалось, то создаем
                Route::createAlias($this->path, 'article/default/view', 'article', $this->id);
            }
        } else {
            //Если такой алиас уже есть, то надо убедиться, что он привязан к данному материалу, а не к какому-то другому
            if (!Route::findByModel('article', $this->id, $this->path)) {
                //Значит такой алиас уже принадлежит какому-то другому материалу
                //Меняем path. В таком виде он точно будет уникальным
                $this->path = $this->id . '_article_' . $this->path;
                $this->save();
                //Снова проверяем алиас. Если его нет, то создаем
                if (!Route::findAlias($this->path)) {
                    if (!Route::updateByModel('article', $this->id, $this->path)) {
                        //Если алиаса еще не создавалось, то создаем
                        Route::createAlias($this->path, 'article/default/view', 'article', $this->id);
                    }
                }
            }
        }
    }

    public function checkHits() {

        $session = Yii::$app->session;
        if(!$session->has('hits_array'))
            {

            $session->set('hits_array', array());
            
            }

            $temp = $session->get('hits_array');
            if(!in_array($this->id, $temp) || empty($temp))
                {
                
                $temp[] = $this->id;
                $session->set('hits_array', $temp);

                $this->updateCounters(['hits' => 1]);
                
                }
    }
    
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                ->viaTable('tag_article', ['article_id' => 'id']);
    }
}
