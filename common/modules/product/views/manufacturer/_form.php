<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'shortname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'activity_kind')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->widget(TinyMce::class, [
                'options' => ['rows' => 10],
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

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_networks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branches')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_person')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'additional_files')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
