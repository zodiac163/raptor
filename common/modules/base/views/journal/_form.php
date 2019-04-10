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

    <?= $form->field($model, 'description')->widget(TinyMce::class, [
                'options' => ['rows' => 6],
                'language' => 'ru',
                'clientOptions' => [
                    'plugins' => [
                        'advlist autolink lists link charmap hr preview pagebreak',
                        'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                        'save insertdatetime media table contextmenu template paste image responsivefilemanager filemanager',
                    ],
                    'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager link image media',
                    'external_filemanager_path' => '/master/plugins/responsivefilemanager/filemanager/',
                    'filemanager_title' => 'Filemanager',
                    'external_plugins' => [
                        //Иконка/кнопка загрузки файла в диалоге вставки изображения.
                        'filemanager' => '/master/plugins/responsivefilemanager/filemanager/plugin.min.js',
                        //Иконка/кнопка загрузки файла в панеле иснструментов.
                        'responsivefilemanager' => '/master/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                    ],
                ]
            ]); ?>
    
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
