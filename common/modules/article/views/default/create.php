<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */

$this->title = Yii::t('art_mod', 'ARTICLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art_mod', 'ARTICLE_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
