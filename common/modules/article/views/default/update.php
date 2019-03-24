<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */
/* @var $initialPreview array - array of images' links for preview*/
/* @var $initialPreviewConfig array - array of full images' information for preview*/

$this->title = Yii::t('app', 'UPDATE') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('art_mod', 'ARTICLE_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>
