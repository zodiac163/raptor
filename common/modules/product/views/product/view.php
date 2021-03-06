    <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\product\models\ProductCategory;
use common\models\User;
use yii\helpers\Url;
use common\modules\product\models\Manufacturer;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_PRODUCTS_PRODUCT'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'description',
                'value' => function ($data) {
                    return $data->description ? $data->description : null;
                }
            ],
            'alias',
            [
                'attribute' => 'manufacturer_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->category_id === 0) {
                        $category = "<span class='has-error'>" . Yii::t('prod_mod', 'PARENT_ERROR') . "</span>";
                    } else {
                        $findCategory = Manufacturer::findOne(['id' => $data->manufacturer_id]);
                        if ($findCategory) {
                            $category = $findCategory->shortname;
                        } else {
                            $category = "<span class='has-error'>" . Yii::t('prod_mod', 'PARENT_ERROR') . "</span>";
                        }
                    }
                    return $category;
                }
            ],
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->category_id === 0) {
                        $category = "<span class='has-error'>" . Yii::t('prod_mod', 'PARENT_ERROR') . "</span>";
                    } else {
                        $findCategory = ProductCategory::findOne(['id' => $data->category_id]);
                        if ($findCategory) {
                            $category = $findCategory->title;
                        } else {
                            $category = "<span class='has-error'>" . Yii::t('prod_mod', 'PARENT_ERROR') . "</span>";
                        }
                    }
                    return $category;
                }
            ],
            [
                'attribute' => 'featured',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->featured ?
                        '<span class="text-success">' . Yii::t('app', 'YES') . '</span>' :
                        '<span class="text-danger">' . Yii::t('app', 'NO') . '</span>';
                }
            ],
            'ordering',
            [
                'attribute' => 'published',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->published ?
                        '<span class="text-success">' . Yii::t('app', 'YES') . '</span>' :
                        '<span class="text-danger">' . Yii::t('app', 'NO') . '</span>';
                }
            ],
            'hits',
            'language',
            [
                'attribute' => 'metadata',
                'value' => function ($data) {
                    return $data->metadata ? $data->metadata : null;
                }
            ],
            'manufacturer_link',
            'video_link:ntext',
            'code',
            'specifications:ntext',
            'additional_equipment:ntext',
            [
                'attribute' => 'created_user_id',
                'value' => function ($data) {
                    $author = User::findOne(['id' => $data->created_user_id]);
                    if ($author) {
                        $created_user_id = $author->username;
                    } else {
                        $created_user_id = "<span class='has-error'>" . Yii::t('base_mod', 'USER_ERROR') . "</span>";
                    }
                    return $created_user_id;
                }
            ],
            [
                'attribute' => 'created_time',
                'value' => function ($data) {
                    return $data->created_time ? date('d.m.Y H:i', strtotime($data->created_time)) : null;
                }
            ],
            [
                'attribute' => 'modified_user_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->modified_user_id) {
                        $author = User::findOne(['id' => $data->modified_user_id]);
                        if ($author) {
                            $modified_user_id = $author->username;
                        } else {
                            $modified_user_id = "<span class='has-error'>" . Yii::t('base_mod', 'USER_ERROR') . "</span>";
                        }
                    } else {
                        $modified_user_id = "<span class='text-yellow'>" . Yii::t('base_mod', 'NOT_MODIFY') . "</span>";
                    }
                    return $modified_user_id;
                }
            ],
            [
                'attribute' => 'modified_time',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->modified_time === '0000-00-00 00:00:00' ?
                        "<span class='text-yellow'>" . Yii::t('base_mod', 'NOT_MODIFY') . "</span>" :
                        date('d.m.Y H:i', strtotime($data->modified_time));
                }
            ]
        ],
    ]) ?>
    
    <h3>Изображения</h3>
    <div>
        <?=
        \powerkernel\photoswipe\Gallery::widget([
            'items' => $images
        ])
        ?>
    </div>

</div>
