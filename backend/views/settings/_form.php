<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sys_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_state')->textInput() ?>

    <?= $form->field($model, 'sys_slogan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_footer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adm_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
