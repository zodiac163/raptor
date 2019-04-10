<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\switchinput\SwitchInput;

common\modules\product\assets\ProdAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'manufacturer_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(\common\modules\product\models\Manufacturer::find()->all(), 'id', 'shortname'),
        'options' => ['placeholder' => Yii::t('prod_mod', 'MANUFACTURER_SELECT')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(\common\modules\product\models\ProductCategory::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => Yii::t('prod_mod', 'CATEGORY_SELECT_PARENT')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'manufacturer_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
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
        'maxFileCount' => 10,
        'uploadUrl' => Url::to(['/product/product/upload']),
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
    
    <?= $form->field($model, 'images')->hiddenInput(['id' => 'uploaded-images'])->label(false) ?>
    
    <div class="row">
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
    
    <?= $form->field($model, 'metadata')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'video_link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'specifications')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'additional_equipment')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
