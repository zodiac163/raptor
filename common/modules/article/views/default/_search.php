<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'introtext') ?>

    <?= $form->field($model, 'fulltext') ?>

    <?php // echo $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'featured') ?>

    <?php // echo $form->field($model, 'ordering') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <?php // echo $form->field($model, 'metadata') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'created_user_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'modified_user_id') ?>

    <?php // echo $form->field($model, 'modified_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('art_mod', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('art_mod', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
