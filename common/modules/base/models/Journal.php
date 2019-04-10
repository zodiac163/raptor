<?php

namespace common\modules\base\models;

use Yii;
use common\models\User;
use yii\helpers\Url;

/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string $image
 * @property string $description
 * @property int $hits
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 *
 * @property User $createdUser
 * @property User $modifiedUser
 * @property JournalKnowledgeBase[] $journalKnowledgeBases
 * @property KnowledgeBase[] $knowledgeBases
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'image', 'description'], 'required'],
            [['date', 'created_time', 'modified_time'], 'safe'],
            [['hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['language'], 'string', 'max' => 7],
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
            'date' => Yii::t('base_mod', 'DATE'),
            'image' => Yii::t('base_mod', 'IMAGE'),
            'description' => Yii::t('base_mod', 'DESCRIPTION'),
            'hits' => Yii::t('base_mod', 'HITS'),
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
        $baseImage = json_decode($this->image);
        if ($baseImage && isset($baseImage->urls)) {
            foreach ($baseImage->urls as $image) {
                $initialPreview[] = $protocol . Yii::$app->params['fileStore'] . $image->url;
                $image->key = $image->url;
                $image->url = Url::to(['/base/journal/removefile']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalKnowledgeBases()
    {
        return $this->hasMany(JournalKnowledgeBase::className(), ['journal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledgeBases()
    {
        return $this->hasMany(KnowledgeBase::className(), ['id' => 'knowledge_base_id'])->viaTable('journal_knowledge_base', ['journal_id' => 'id']);
    }
}
