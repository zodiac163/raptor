<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBaseCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'KNOWLEDGE_BASE_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="knowledge-base-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_mod', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base_mod', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base_mod', 'SURE_TO_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'level',
            'path',
            'alias',
            'title',
            'description:ntext',
            'published',
            'params:ntext',
            'metadata:ntext',
            'language',
            'created_user_id',
            'created_time',
            'modified_user_id',
            'modified_time',
        ],
    ]) ?>

</div>
