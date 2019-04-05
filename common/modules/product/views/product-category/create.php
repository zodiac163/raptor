<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\ProductCategory */

$this->title = Yii::t('app', 'NAV_PRODUCTS_CATEGORY'). ':' .Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_PRODUCTS_CATEGORY'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
