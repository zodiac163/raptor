<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */
/* @var $initialPreview array - array of images' links for preview*/
/* @var $initialPreviewConfig array - array of full images' information for preview*/

$this->title = Yii::t('art_mod', 'Update Article: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('art_mod', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('art_mod', 'Update');
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>
