<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <!-- TODO1: Не увидел поле Language -->
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer_id')->textInput() ?> <!-- TODO1: Нужен выпадающий список категорий, пример в common/modules/article/views/default/_form.php в поле cat_id -->

    <?= $form->field($model, 'category_id')->textInput() ?> <!-- TODO1: Нужен выпадающий список категорий, пример в common/modules/article/views/default/_form.php в поле cat_id -->

    <?= $form->field($model, 'images')->textarea(['rows' => 6]) ?> <!-- TODO1: Нужено сделать через FileInput, пример в common/modules/article/views/default/_form.php -->

    <?= $form->field($model, 'featured')->textInput() ?> <!-- TODO1: Переключатель пример в common/modules/article/views/default/_form.php, поле featured -->

    <?= $form->field($model, 'published')->textInput() ?> <!-- TODO1: Переключатель пример в common/modules/article/views/default/_form.php, поле featured -->

    <?= $form->field($model, 'metadata')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manufacturer_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_link')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specifications')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'additional_equipment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'created_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <?= $form->field($model, 'modified_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'modified_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
