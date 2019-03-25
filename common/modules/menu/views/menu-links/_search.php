<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\MenuLinksSerach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-links-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'menu_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'created_user_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'modified_user_id') ?>

    <?php // echo $form->field($model, 'modified_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('menu_mod', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('menu_mod', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
