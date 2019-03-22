<?php

use common\modules\category\models\Category;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

common\modules\article\assets\ArticleAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cat_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Category::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('art_mod', 'ARTICLE_CAT_SELECT')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'introtext')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'fulltext')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo FileInput::widget([
                    'id' => 'fileUpload',
                    'name' => 'fileUpload[]',
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  'Select Photo',
                        'maxFileCount' => 10,
                        'uploadUrl' => Url::to(['/article/default/upload']),
                        'uploadAsync' => false,
                        'initialPreviewAsData' => true,
                        'overwriteInitial' => false,
                    ],
                    'options' => [
                        'accept' => 'image/*',
                        'multiple'=>true,
                        'progressClass' => 'hide',
                    ]
                ]); ?>
            </div>
        </div>
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
            <?= $form->field($model, 'featured')->widget(SwitchInput::class, [
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
            <?= $form->field($model, 'metadata')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .file-input .fileinput-remove {
        display: none;
    }

    .row {
        border-bottom: 1px solid #d0d1d2;
        margin-bottom: 15px;
        padding-bottom: 7px;
    }
</style>
