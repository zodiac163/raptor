<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\base\models\KnowledgeBaseCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_mod', 'KNOWLEDGE_BASE_CATEGORIES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowledge-base-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('base_mod', 'CREATE_KNOWLEDGE_BASE_CATEGORY'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            'level',
            'path',
            'alias',
            //'title',
            //'description:ntext',
            //'published',
            //'params:ntext',
            //'metadata:ntext',
            //'language',
            //'created_user_id',
            //'created_time',
            //'modified_user_id',
            //'modified_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
