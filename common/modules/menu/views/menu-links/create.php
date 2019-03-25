<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\MenuLinks */
/* @var $menu int - меню, к которому относится ссылка */

$this->title = Yii::t('menu_mod', 'MENU_LINK_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu_mod', 'MENU_LINK_LINKS'), 'url' => ['index', 'menu' => $menu]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-links-create">

    <?= $this->render('_form', [
        'model' => $model,
        'menu' => $menu,
    ]) ?>

</div>
