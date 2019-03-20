<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'MODULE_USERS_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'MODULE_USERS_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'label' => Yii::t('app', 'MODULE_USERS_LABEL_STATUS'),
                'value' => function($data){
                    $status = Yii::t('app', 'MODULE_USERS_STATUS_DELETE');
                    switch ($data->status) {
                        case 0: $status = Yii::t('app','MODULE_USERS_STATUS_DELETE'); break;
                        case 10: $status = Yii::t('app','MODULE_USERS_STATUS_ACTIVE'); break;
                    }
                    return $status;
                }
            ],
            [
                'label' => Yii::t('app', 'MODULE_USERS_LABEL_CREATED'),
                'value' => function($data){
                    return date('d.m.Y H:i', $data->created_at);
                }
            ],
            //'updated_at',
            [
                'class' => \yii\grid\ActionColumn::class,
                'template'=>'{view}  {update}  {permit}',
                'buttons' =>
                    [
                        'permit' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-wrench"></span>', Url::to(['/permit/user/view', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Change user role')
                            ]); },
                    ]
            ],
        ],
    ]); ?>
</div>
