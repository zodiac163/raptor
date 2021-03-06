<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-category-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'parent_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(\common\modules\product\models\ProductCategory::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => Yii::t('prod_mod', 'CATEGORY_SELECT_PARENT')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'language')->dropDownList(['*' => 'Любой', 'ru-RU' => 'Русский', 'en-US' => 'Английский']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SAVE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
