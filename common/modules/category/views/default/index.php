<?php

use common\modules\category\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cat_mod', 'CATEGORY_PAGE_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('cat_mod', 'CATEGORY_CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'path',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->parent_id === 0) {
                        $parent = Yii::t('app', 'ROOT');
                    } else {
                        $parentCategory = Category::findOne(['id' => $data->parent_id]);
                        if ($parentCategory) {
                            $parent = Html::a($parentCategory->title, Url::to(['/category/default/view', 'id' => $parentCategory->id ]));
                        } else {
                            $parent = "<span class='has-error'>" . Yii::t('cat_mod', 'CATEGORY_PARENT_ERROR') . "</span>";
                        }
                    }
                    return $parent;
                }
            ],
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>
</div>
