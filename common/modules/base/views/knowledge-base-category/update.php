<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBaseCategory */

$this->title = Yii::t('base_mod', 'Update Knowledge Base Category: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'KNOWLEDGE_BASE_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_mod', 'UPDATE');
?>
<div class="knowledge-base-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
