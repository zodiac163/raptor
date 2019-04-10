<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBaseCategory */

$this->title = Yii::t('base_mod', 'CREATE_KNOWLEDGE_BASE_CATEGORY');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'KNOWLEDGE_BASE_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowledge-base-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
