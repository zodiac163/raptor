<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use common\modules\base\models\KnowledgeBaseCategory;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;

common\modules\base\assets\BaseAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="knowledge-base-form">

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
                'data' => ArrayHelper::map(KnowledgeBaseCategory::find()->all(), 'id', 'title'),
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
            <?= $form->field($model, 'fulltext')->widget(TinyMce::class, [
                'options' => ['rows' => 22],
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
                'uploadUrl' => Url::to(['/base/knowledge-base/upload']),
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
    
    <?= $form->field($model, 'images')->hiddenInput(['id' => 'uploaded-images'])->label(false) ?>

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
    <?= $form->field($model, 'ordering')->textInput() ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'metadata')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_mod', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
