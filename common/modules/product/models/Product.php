<?php

namespace common\modules\product\models;

use Yii;
use common\models\User;
use yii\helpers\Url;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property int $manufacturer_id
 * @property int $category_id
 * @property string $images
 * @property int $featured
 * @property int $ordering
 * @property int $published
 * @property int $hits
 * @property string $metadata
 * @property string $manufacturer_link
 * @property string $video_link
 * @property string $code
 * @property string $specifications
 * @property string $additional_equipment
 * @property int $created_user_id
 * @property string $created_time
 * @property int $modified_user_id
 * @property string $modified_time
 *
 * @property ProductCategory $category
 * @property Manufacturer $manufacturer
 * @property User $createdUser
 * @property User $modifiedUser
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'alias', 'manufacturer_id', 'category_id', 'featured', 'published'], 'required'],
            [['description', 'images', 'metadata', 'video_link', 'specifications', 'additional_equipment', 'language'], 'string'],
            [['manufacturer_id', 'category_id', 'featured', 'ordering', 'published', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['created_time', 'modified_time'], 'safe'],
            [['title', 'manufacturer_link'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 95],
            [['code'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['created_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_user_id' => 'id']],
            [['modified_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_user_id' => 'id']],
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_user_id = Yii::$app->user->id;
                $this->hits = 0;
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('prod_mod', 'ID'),
            'title' => Yii::t('prod_mod', 'TITLE'),
            'description' => Yii::t('prod_mod', 'DESCRIPTION'),
            'alias' => Yii::t('prod_mod', 'ALIAS'),
            'manufacturer_id' => Yii::t('prod_mod', 'MANUFACTURER_ID'),
            'category_id' => Yii::t('prod_mod', 'CATEGORY_ID'),
            'images' => Yii::t('prod_mod', 'IMAGES'),
            'featured' => Yii::t('prod_mod', 'FEATURED'),
            'ordering' => Yii::t('prod_mod', 'ORDERING'),
            'published' => Yii::t('prod_mod', 'PUBLISHED'),
            'language' => Yii::t('prod_mod', 'LANGUAGE'),
            'hits' => Yii::t('prod_mod', 'HITS'),
            'metadata' => Yii::t('prod_mod', 'METADATA'),
            'manufacturer_link' => Yii::t('prod_mod', 'MANUFACTURER_LINK'),
            'video_link' => Yii::t('prod_mod', 'VIDEO_LINK'),
            'code' => Yii::t('prod_mod', 'CODE'),
            'specifications' => Yii::t('prod_mod', 'SPECIFICATIONS'),
            'additional_equipment' => Yii::t('prod_mod', 'ADDITIONAL_EQUIPMENT'),
            'created_user_id' => Yii::t('prod_mod', 'CREATED_USER_ID'),
            'created_time' => Yii::t('prod_mod', 'CREATED_TIME'),
            'modified_user_id' => Yii::t('prod_mod', 'MODIFIED_USER_ID'),
            'modified_time' => Yii::t('prod_mod', 'MODIFIED_TIME'),
        ];
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
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
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
