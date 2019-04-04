<?php

use common\modules\category\models\Category;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\article\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art_mod', 'ARTICLE_PAGE_TAGS');
$this->params['breadcrumbs'][] = $this->title;

// the grid columns setup (only two column entries are shown here
// you can add more column entries you need for your use case)
$gridColumns = [
// the name column configuration
[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'title',
    'editableOptions'=> function ($model, $key, $index) {
        return [
            'header'=>Yii::t('app', 'TAG_TITLE'),
            'size'=>'md',
            'formOptions'=>['action' => ['/article/tag/editTag']], // point to the new action
        ];
    }
],
        
[
    'class' => 'kartik\grid\ActionColumn',
    'template' => '{delete}',
    'buttons'  => [
        'delete' => function ($url, $model) {
            $url = Url::to(['/article/tag/deletetag', 'id' => $model->id]);
            return Html::a('<span class="fa fa-trash"></span>', $url, [
                'title'        => 'delete',
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'data-method'  => 'POST',
                'data-params'  => [ 'id' => $model->id ],
            ]);
        },
    ], 
]
        
];

// the GridView widget (you must use kartik\grid\GridView)
echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,

    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' =>  [

    ],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],
    'responsive' => false,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => Yii::t('app', 'TAG_TITLE'),
    ],
]);

?>

