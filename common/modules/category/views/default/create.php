<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\category\models\Category */

$this->title = Yii::t('cat_mod', 'CATEGORY_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cat_mod', 'CATEGORY_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
