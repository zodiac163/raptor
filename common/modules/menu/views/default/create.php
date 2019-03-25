<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\Menu */

$this->title = Yii::t('menu_mod', 'MENU_PAGE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu_mod', 'MENU_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
