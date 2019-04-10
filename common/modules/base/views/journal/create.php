<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\Journal */

$this->title = Yii::t('base_mod', 'CREATE_JOURNAL');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'JOURNALS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>
