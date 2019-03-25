<?php

use common\modules\menu\models\Menu;
use common\modules\menu\models\MenuLinks;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\MenuLinks */
/* @var $form yii\widgets\ActiveForm */
/* @var $menu int - меню, к которому относится ссылка */
?>

<div class="menu-links-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row admin-menu-top-panel" style="margin-bottom: 30px;">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::textInput('mid', Menu::findOne(['id' => $menu])->title, ['class' => 'form-control', 'readonly' => 'readonly']) ?>
            <?= $form->field($model, 'menu_id')->hiddenInput()->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'parent_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(MenuLinks::find()->where(['menu_id' => $menu])->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('menu_mod', 'MENU_LINK_SELECT_PARENT')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
