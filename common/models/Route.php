<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property int $id
 * @property string $alias
 * @property string $route_path
 * @property string $created_time
 * @property string $model_id
 * @property int $row_id
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'route_path'], 'required'],
            [['created_time'], 'safe'],
            [['row_id'], 'integer'],
            [['alias', 'route_path'], 'string', 'max' => 900],
            [['model_id'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'route_path' => Yii::t('app', 'Route Path'),
            'created_time' => Yii::t('app', 'Created Time'),
            'model_id' => Yii::t('app', 'Model ID'),
            'row_id' => Yii::t('app', 'Row ID'),
        ];
    }

    public static function findAlias($alias) {
        return Route::findOne(['alias' => $alias]) ? true : false;
    }

    public static function createAlias($alias, $route_path, $model, $row) {
        $route = new Route();
        $route->alias = $alias;
        $route->route_path = $route_path;
        $route->model_id = $model;
        $route->row_id = $row;
        $route->save();
    }

    public static function findByModel($model, $id, $alias) {
        return Route::findOne(['model_id' => $model, 'row_id' => $id, 'alias' => $alias]) ? true : false;
    }

    public static function updateByModel($model, $id, $alias) {
        $r = Route::findOne(['model_id' => $model, 'row_id' => $id]);
        if ($r) {
            $r->alias = $alias;
            $r->save();
            return true;
        } else {
            return false;
        }
    }
}
