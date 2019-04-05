<?php

namespace common\modules\product\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string $fullname
 * @property string $shortname
 * @property string $description
 * @property string $activity_kind
 * @property string $address
 * @property string $phone
 * @property string $site
 * @property string $mail
 * @property string $social_networks
 * @property string $branches
 * @property string $contact_person
 * @property string $logo
 * @property string $additional_files
 * @property string $language
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 *
 * @property User $createdUser
 * @property User $modifiedUser
 * @property Product[] $products
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'shortname', 'created_user_id'], 'required'],
            [['description', 'social_networks', 'branches', 'contact_person', 'additional_files'], 'string'],
            [['created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['fullname', 'activity_kind', 'address', 'site', 'logo'], 'string', 'max' => 225],
            [['shortname', 'phone', 'mail'], 'string', 'max' => 45],
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
            'fullname' => Yii::t('prod_mod', 'FULLNAME'),
            'shortname' => Yii::t('prod_mod', 'SHORTNAME'),
            'description' => Yii::t('prod_mod', 'DESCRIPTION'),
            'activity_kind' => Yii::t('prod_mod', 'ACTIVITY_KIND'),
            'address' => Yii::t('prod_mod', 'ADDRESS'),
            'phone' => Yii::t('prod_mod', 'PHONE'),
            'site' => Yii::t('prod_mod', 'SITE'),
            'mail' => Yii::t('prod_mod', 'MAIL'),
            'social_networks' => Yii::t('prod_mod', 'SOCIAL_NETWORKS'),
            'branches' => Yii::t('prod_mod', 'BRANCHES'),
            'contact_person' => Yii::t('prod_mod', 'CONTACT_PERSON'),
            'logo' => Yii::t('prod_mod', 'LOGO'),
            'additional_files' => Yii::t('prod_mod', 'ADDITIONAL_FILES'),
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }
}
