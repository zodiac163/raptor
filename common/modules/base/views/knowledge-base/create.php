<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBase */

$this->title = Yii::t('base_mod', 'CREATE_KNOWLEDGE_BASE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'KNOWLEDGE_BASES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowledge-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>
