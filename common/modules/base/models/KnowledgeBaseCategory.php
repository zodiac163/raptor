<?php

namespace common\modules\base\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "knowledge_base_category".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $level
 * @property string $path
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property int $published
 * @property string $params
 * @property string $metadata
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 *
 * @property KnowledgeBase[] $knowledgeBases
 * @property User $createdUser
 * @property KnowledgeBaseCategory $parent
 * @property KnowledgeBaseCategory[] $knowledgeBaseCategories
 * @property User $modifiedUser
 */
class KnowledgeBaseCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'knowledge_base_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['path', 'title'], 'required'],
            [['description', 'params', 'metadata'], 'string'],
            [['created_time', 'modified_time'], 'safe'],
            [['path', 'alias'], 'string', 'max' => 400],
            [['title'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 7],
            [['created_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_user_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => KnowledgeBaseCategory::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['modified_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['modified_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_mod', 'ID'),
            'parent_id' => Yii::t('base_mod', 'PARENT_ID'),
            'level' => Yii::t('base_mod', 'LEVEL'),
            'path' => Yii::t('base_mod', 'PATH'),
            'alias' => Yii::t('base_mod', 'ALIAS'),
            'title' => Yii::t('base_mod', 'TITLE'),
            'description' => Yii::t('base_mod', 'DESCRIPTION'),
            'published' => Yii::t('base_mod', 'PUBLISHED'),
            'params' => Yii::t('base_mod', 'PARAMS'),
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
                if($this->parent_id == null or $this->parent_id == '')
                    {
                    $this->parent_id = 1;
                    }
                $this->created_user_id = Yii::$app->user->id;
                } else {
                $this->modified_user_id = Yii::$app->user->id;
            }
            return true;
        } else {
        return false;
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledgeBases()
    {
        return $this->hasMany(KnowledgeBase::className(), ['cat_id' => 'id']);
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
    public function getParent()
    {
        return $this->hasOne(KnowledgeBaseCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledgeBaseCategories()
    {
        return $this->hasMany(KnowledgeBaseCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_user_id']);
    }
}
