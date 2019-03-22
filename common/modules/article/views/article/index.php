<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\article\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('art_mod', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('art_mod', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'path',
            'introtext',
            'fulltext:ntext',
            //'cat_id',
            //'images:ntext',
            //'featured',
            //'ordering',
            //'published',
            //'hits',
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
