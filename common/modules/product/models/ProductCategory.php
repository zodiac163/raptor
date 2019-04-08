<?php

namespace common\modules\product\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $parent_id
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 *
 * @property Product[] $products
 * @property User $createdUser
 * @property User $modifiedUser
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['parent_id', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
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
            'id' => Yii::t('prod_mod', 'ID'),
            'title' => Yii::t('prod_mod', 'TITLE'),
            'description' => Yii::t('prod_mod', 'DESCRIPTION'),
            'parent_id' => Yii::t('prod_mod', 'PARENT_ID'),
            'language' => Yii::t('prod_mod', 'LANGUAGE'),
            'created_user_id' => Yii::t('prod_mod', 'CREATED_USER_ID'),
            'created_time' => Yii::t('prod_mod', 'CREATED_TIME'),
            'modified_user_id' => Yii::t('prod_mod', 'MODIFIED_USER_ID'),
            'modified_time' => Yii::t('prod_mod', 'MODIFIED_TIME'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
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
