<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Manufacturer */

$this->title = Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'). ':' .Yii::t('app', 'CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
