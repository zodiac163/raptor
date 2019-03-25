<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\MenuLinks */
/* @var $menu int - меню, к которому относится ссылка */

$this->title = Yii::t('menu_mod', 'MENU_PAGE_UPDATE', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu_mod', 'MENU_LINK_LINKS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="menu-links-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menu' => $menu,
    ]) ?>

</div>
