<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'sys_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sys_state')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'sys_logo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'adm_mail')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'sys_description')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-md-12">
    <?= $form->field($model, 'sys_logo')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'sys_footer')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-md-12">
        <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>
    </div>
            
    <div class="col-md-12">
        <?= $form->field($model, 'sys_slogan')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
