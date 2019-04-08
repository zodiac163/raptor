<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?> <!-- TODO1: Нужено поменяыть на textarea  -->

    <?= $form->field($model, 'parent_id')->textInput() ?> <!-- TODO1: Нужен выпадающий список категорий, пример в common/modules/category/views/default/_form.php -->

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?> <!-- TODO1: выпадающий список, пример в common/modules/category/views/default/_form.php -->

    <?= $form->field($model, 'created_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'created_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <?= $form->field($model, 'modified_user_id')->textInput() ?> <!-- TODO1: должно подставляться в модели через beforeSave -->

    <?= $form->field($model, 'modified_time')->textInput() ?> <!-- TODO1: должно подставляться в БД через триггер (в этом случае понадобится миграция для создания триггера, пример в console/migrations/m190323_180710_article_update_trigger.php) -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
