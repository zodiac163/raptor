<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\product\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'shortname',
            'activity_kind',
            'phone',
            'mail',
            'contact_person',
            'language',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
