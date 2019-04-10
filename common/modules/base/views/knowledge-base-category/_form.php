<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use common\modules\base\models\KnowledgeBaseCategory;


/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBaseCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="knowledge-base-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'parent_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(KnowledgeBaseCategory::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('base_mod', 'PARENT_ID')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>
            </div>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'metadata')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'level')->textInput() ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'published')->widget(SwitchInput::class, [
                'pluginOptions' => [
                    'onColor' => 'success',
                    'offColor' => 'danger',
                    'onText' => Yii::t('app', 'YES'),
                    'offText' => Yii::t('app', 'NO'),
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
        <?= Html::submitButton(Yii::t('base_mod', 'SAVE'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
