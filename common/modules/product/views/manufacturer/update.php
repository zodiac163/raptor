<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Manufacturer */

$this->title = Yii::t('app', 'UPDATE') . ': ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="manufacturer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
