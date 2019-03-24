<?php

namespace common\modules\category\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "category".
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
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['path', 'title', 'created_user_id'], 'required'],
            [['description', 'params', 'metadata'], 'string'],
            [['created_time', 'modified_time'], 'safe'],
            [['path', 'alias'], 'string', 'max' => 400],
            [['title'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 7],
            [['parent_id'], 'default', 'value'=> 0],
            [['level'], 'default', 'value'=> 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cat_mod', 'ID'),
            'parent_id' => Yii::t('cat_mod', 'CATEGORY_PARENT_ID'),
            'level' => Yii::t('cat_mod', 'CATEGORY_LEVEL'),
            'path' => Yii::t('cat_mod', 'CATEGORY_PATH'),
            'alias' => Yii::t('cat_mod', 'CATEGORY_ALIAS'),
            'title' => Yii::t('cat_mod', 'CATEGORY_TITLE'),
            'description' => Yii::t('cat_mod', 'CATEGORY_DESCRIPTION'),
            'published' => Yii::t('cat_mod', 'CATEGORY_PUBLISHED'),
            'params' => Yii::t('cat_mod', 'CATEGORY_PARAMS'),
            'metadata' => Yii::t('cat_mod', 'CATEGORY_METADATA'),
            'language' => Yii::t('cat_mod', 'CATEGORY_LANGUAGE'),
            'created_user_id' => Yii::t('cat_mod', 'CATEGORY_CREATED_USER_ID'),
            'created_time' => Yii::t('cat_mod', 'CATEGORY_CREATED_TIME'),
            'modified_user_id' => Yii::t('cat_mod', 'CATEGORY_MODIFIED_USER_ID'),
            'modified_time' => Yii::t('cat_mod', 'CATEGORY_MODIFIED_TIME'),
        ];
    }

    public static function findByPath($path) {
        $catArray = explode('/', $path);
        $catSingle = $catArray[count($catArray)-1];
        $cat = Category::findOne(['path' => $catSingle]); //var_dump($path); exit;
        $catIds = [];
        if (!$cat) {
            throw new NotFoundHttpException(Yii::t('art_mod', 'The requested page does not exist.'));
        } else {
            $catIds[] = $cat->id;
            $childs = self::findChildes($cat->id);
            $catIds = array_merge($catIds, $childs);
        }

        return $catIds;
    }

    private static function findChildes($catId) {
        $catArray = [];
        $children = Category::find()->where(['parent_id' => $catId])->all();
        if ($children) {
            foreach ($children as $child) {
                $catArray[] = $child->id;
                $c = self::findChildes($child->id);
                $catArray = array_merge($catArray, $c);
            }
        }

        return $catArray;
    }
}
