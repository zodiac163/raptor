<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\date\DatePicker;

common\modules\base\assets\BaseAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\Journal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>
        </div>
    </div>
    <?php echo FileInput::widget([
            'id' => 'fileUpload',
            'name' => 'fileUpload[]',
            'pluginOptions' => [
                'initialPreview' => $initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  'Select Photo',
                'maxFileCount' => 1,
                'uploadUrl' => Url::to(['/base/journal/upload']),
                'uploadAsync' => false,
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
            ],
            'options' => [
                'accept' => 'image/*',
                'multiple'=>false,
                'progressClass' => 'hide',
            ]
        ])
    ;
    ?>
    
    <?= $form->field($model, 'image')->hiddenInput(['id' => 'uploaded-images'])->label(false) ?>

    <?= $form->field($model, 'description')->textInput() ?>
    
    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'name' => 'datepicker',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'value' => date('yyyy-mm-dd'),
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_mod', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
