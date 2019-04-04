<?php

namespace common\modules\article\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $title
 * @property int $created_user_id
 * @property string $category_id
 *
 * @property User $createdUser
 * @property TagArticle[] $tagArticles
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_user_id'], 'required'],
            [['created_user_id'], 'integer'],
            [['category_id'], 'safe'],
            [['title'], 'string', 'max' => 20],
            [['created_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_user_id' => 'id']],
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
            'created_user_id' => Yii::t('art_mod', 'Created User ID'),
            'category_id' => Yii::t('art_mod', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
                ->viaTable('tag_article', ['tag_id' => 'id']);
    }

    public static function getAllTags()
    {

    return Tag::find()->select(['id', 'title'])->all();

    }
}
