<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\Menu */

$this->title = Yii::t('app', 'UPDATE', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu_mod', 'MENU_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
