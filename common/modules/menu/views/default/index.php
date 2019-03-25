<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\menu\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menu_mod', 'MENU_PAGE_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <p>
        <?= Html::a(Yii::t('menu_mod', 'MENU_PAGE_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'published',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->published ?
                        '<span class="text-success">' . Yii::t('app', 'YES') . '</span>' :
                        '<span class="text-danger">' . Yii::t('app', 'NO') . '</span>';
                },
                'filter'=>[
                    1 => Yii::t('app', 'YES'),
                    0 => Yii::t('app', 'NO'),
                ]
            ],
            [
                'attribute' => 'language',
                'filter'=>[

                    '*' => Yii::t('app', 'ALL'),
                    'ru-RU' => Yii::t('app', 'RU'),
                    'en-US' => Yii::t('app', 'EN'),
                ]
            ],
            [
                'attribute' => 'created_user_id',
                'value' => function ($data) {
                    $author = User::findOne(['id' => $data->created_user_id]);
                    if ($author) {
                        $created_user_id = $author->username;
                    } else {
                        $created_user_id = "<span class='has-error'>" . Yii::t('cat_mod', 'CATEGORY_USER_ERROR') . "</span>";
                    }
                    return $created_user_id;
                }
            ],
            //'created_time',
            //'modified_user_id',
            //'modified_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'links'=>function ($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['menu/menu-links/index','menu'=>$model->id]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-link"></span>', $customurl,
                            ['title' => Yii::t('menu_mod', 'MENU_LINK_LINK_LIST'), 'data-pjax' => '0']);
                    }
                ],
                'template' => '{links} {view} {update}'
            ],
        ],
    ]); ?>
</div>
