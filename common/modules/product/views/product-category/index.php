<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\product\models\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'NAV_PRODUCTS_CATEGORY');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    
    $gridColumns = [
[
    'class' => 'kartik\grid\DataColumn',
    'attribute' => 'title',
    'vAlign' => 'middle',
    'width' => '180px',
    'header' => Yii::t('prod_mod', 'TITLE'),
],
[
    'class' => 'kartik\grid\DataColumn',
    'attribute' => 'description',
    'vAlign' => 'middle',
    'width' => '180px',
    'header' => Yii::t('prod_mod', 'DESCRIPTION'),
],
[
    'class' => 'kartik\grid\DataColumn',
    'attribute' => 'language',
    'vAlign' => 'middle',
    'width' => '180px',
    'header' => Yii::t('prod_mod', 'LANGUAGE'),
],
[
    'class' => 'kartik\grid\ActionColumn',
    'template' => '{view} {update} {delete}',
    'buttons'  => [
        'view'   => function ($url, $model) {
            $url = Url::to(['product-category/view', 'id' => $model->id]);
            return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => Yii::t('app', 'VIEW')]);
        },
        'update' => function ($url, $model) {
            $url = Url::to(['product-category/update', 'id' => $model->id]);
            return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => Yii::t('app', 'UPDATE')]);
        },
        'delete' => function ($url, $model) {
            $url = Url::to(['product-category/delete', 'id' => $model->id]);
            return Html::a('<span class="fa fa-trash"></span>', $url, [
                'title' => Yii::t('app', 'DELETE'),
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'data-method'  => 'POST',
                'data-params'  => [ 'id' => $model->id ],
                ]);
        },
    ],
    'headerOptions' => ['class' => 'kartik-sheet-style'],
],

];
    
    echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' =>  [
        
    ],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => false,
    'hover' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'),
    ],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 5],
]);
    
    ?>
</div>
