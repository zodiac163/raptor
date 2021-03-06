<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\product\models\Manufacturer */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manufacturer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullname',
            'shortname',
            'description:ntext',
            'activity_kind',
            'address',
            'phone',
            'site',
            'mail',
            'social_networks:ntext',
            'branches:ntext',
            'contact_person:ntext',
            'logo',
            'additional_files:ntext',
            'language',
            'created_user_id',
            'created_time',
            'modified_user_id',
            'modified_time',
        ],
    ]) ?>

</div>
