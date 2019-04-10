<?php

namespace common\modules\base\models;

use Yii;
use common\models\User;
use yii\helpers\Url;

/**
 * This is the model class for table "knowledge_base".
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
 *
 * @property JournalKnowledgeBase[] $journalKnowledgeBases
 * @property Journal[] $journals
 * @property KnowledgeBaseCategory $cat
 * @property User $createdUser
 * @property User $modifiedUser
 */
class KnowledgeBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'knowledge_base';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'path', 'introtext', 'fulltext', 'ordering'], 'required'],
            [['fulltext', 'images', 'metadata'], 'string'],
            [['cat_id', 'featured', 'ordering', 'published', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 400],
            [['introtext'], 'string', 'max' => 1000],
            [['language'], 'string', 'max' => 7],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => KnowledgeBaseCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['created_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_user_id' => 'id']],
            [['modified_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_mod', 'ID'),
            'title' => Yii::t('base_mod', 'TITLE'),
            'path' => Yii::t('base_mod', 'PATH'),
            'introtext' => Yii::t('base_mod', 'INTROTEXT'),
            'fulltext' => Yii::t('base_mod', 'FULLTEXT'),
            'cat_id' => Yii::t('base_mod', 'CAT_ID'),
            'images' => Yii::t('base_mod', 'IMAGES'),
            'featured' => Yii::t('base_mod', 'FEATURED'),
            'ordering' => Yii::t('base_mod', 'ORDERING'),
            'published' => Yii::t('base_mod', 'PUBLISHED'),
            'hits' => Yii::t('base_mod', 'HITS'),
            'metadata' => Yii::t('base_mod', 'METADATA'),
            'language' => Yii::t('base_mod', 'LANGUAGE'),
            'created_user_id' => Yii::t('base_mod', 'CREATED_USER_ID'),
            'created_time' => Yii::t('base_mod', 'CREATED_TIME'),
            'modified_user_id' => Yii::t('base_mod', 'MODIFIED_USER_ID'),
            'modified_time' => Yii::t('base_mod', 'MODIFIED_TIME'),
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_user_id = Yii::$app->user->id;
                } else {
                $this->modified_user_id = Yii::$app->user->id;
            }
            return true;
        } else {
        return false;
        }
    }
    
    public function imagePreparation() {
        $initialPreview = [];
        $initialPreviewConfig = [];

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $baseImages = json_decode($this->images);
        if ($baseImages && isset($baseImages->urls)) {
            foreach ($baseImages->urls as $image) {
                $initialPreview[] = $protocol . Yii::$app->params['fileStore'] . $image->url;
                $image->key = $image->url;
                $image->url = Url::to(['/base/knowledge-base/removefile']);
                $initialPreviewConfig[] = $image;
            }
        }

        return [
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalKnowledgeBases()
    {
        return $this->hasMany(JournalKnowledgeBase::className(), ['knowledge_base_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id' => 'journal_id'])->viaTable('journal_knowledge_base', ['knowledge_base_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(KnowledgeBaseCategory::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_user_id']);
    }
}
