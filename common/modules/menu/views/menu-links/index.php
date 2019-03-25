<?php

use common\modules\menu\models\Menu;
use common\modules\menu\models\MenuLinks;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\menu\models\MenuLinksSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $menu int - меню, к которому относится набор ссылок */

$menuTitle = Menu::findOne(['id' => $menu])->title;
$this->params['breadcrumbs'][] = ['label' =>  $menuTitle, 'url' => ['default/view', 'id' => $menu]];
$this->title = $menuTitle;
$this->params['breadcrumbs'][] =Yii::t('menu_mod', 'MENU_LINK_LINKS');
?>
<div class="menu-links-index">

    <p>
        <?= Html::a(Yii::t('menu_mod', 'MENU_LINK_CREATE'), ['create', 'menu' => $menu], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'link',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->parent_id === null) {
                        $parent = Yii::t('app', 'ROOT');
                    } else {
                        $parentCategory = MenuLinks::findOne(['id' => $data->parent_id]);
                        if ($parentCategory) {
                            $parent = $parentCategory->title;
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
            //'created_user_id',
            //'created_time',
            //'modified_user_id',
            //'modified_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>
</div>
