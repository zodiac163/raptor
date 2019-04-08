<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?> <!-- TODO1: Нужен wysiwyg как в common/modules/article/views/default/_form.php в поле fulltext -->

    <?= $form->field($model, 'activity_kind')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_networks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'branches')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_person')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'additional_files')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?> <!-- TODO1: Нужен выпадающий список, пример в common/modules/category/views/default/_form.php -->

    <?= $form->field($model, 'created_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'created_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <?= $form->field($model, 'modified_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'modified_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
