<?php

use common\models\User;
use common\modules\category\models\Category;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */
/* @var $images array */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('art_mod', 'ARTICLE_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <p>
        <?= Html::a(Yii::t('app', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('art_mod', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'path',
            'introtext',
            [
                'attribute' => 'fulltext',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->path ?
                        '<a href="//'.Yii::$app->urlManager->hostInfo.'/'.$data->path.'" target="_blank">'.Yii::t('art_mod', 'ARTICLE_OPEN_MATERIAL').'</a>' :
                        '<a href="//'.Yii::$app->urlManager->hostInfo.'/article/'.$data->id.'" target="_blank">'.Yii::t('art_mod', 'ARTICLE_OPEN_MATERIAL').'</a>';
                }
            ],
            [
                'attribute' => 'cat_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->cat_id === 0) {
                        $category = "<span class='has-error'>" . Yii::t('cat_mod', 'CATEGORY_PARENT_ERROR') . "</span>";
                    } else {
                        $findCategory = Category::findOne(['id' => $data->cat_id]);
                        if ($findCategory) {
                            $category = $findCategory->title;
                        } else {
                            $category = "<span class='has-error'>" . Yii::t('cat_mod', 'CATEGORY_PARENT_ERROR') . "</span>";
                        }
                    }
                    return $category;
                }
            ],
            [
                'attribute' => 'featured',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->featured ?
                        '<span class="text-success">' . Yii::t('app', 'YES') . '</span>' :
                        '<span class="text-danger">' . Yii::t('app', 'NO') . '</span>';
                }
            ],
            [
                'attribute' => 'published',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->published ?
                        '<span class="text-success">' . Yii::t('app', 'YES') . '</span>' :
                        '<span class="text-danger">' . Yii::t('app', 'NO') . '</span>';
                }
            ],
            'ordering',
            'hits',
            [
                'attribute' => 'metadata',
                'value' => function ($data) {
                    return $data->metadata ? $data->metadata : null;
                }
            ],
            'language',
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
            [
                'attribute' => 'created_time',
                'value' => function ($data) {
                    return $data->created_time ? date('d.m.Y H:i', strtotime($data->created_time)) : null;
                }
            ],
            [
                'attribute' => 'modified_user_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->modified_user_id) {
                        $author = User::findOne(['id' => $data->modified_user_id]);
                        if ($author) {
                            $modified_user_id = $author->username;
                        } else {
                            $modified_user_id = "<span class='has-error'>" . Yii::t('cat_mod', 'CATEGORY_USER_ERROR') . "</span>";
                        }
                    } else {
                        $modified_user_id = "<span class='text-yellow'>" . Yii::t('cat_mod', 'CATEGORY_NOT_MODIFY') . "</span>";
                    }
                    return $modified_user_id;
                }
            ],
            [
                'attribute' => 'modified_time',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->modified_time === '0000-00-00 00:00:00' ?
                        "<span class='text-yellow'>" . Yii::t('cat_mod', 'CATEGORY_NOT_MODIFY') . "</span>" :
                        date('d.m.Y H:i', strtotime($data->modified_time));
                }
            ]
        ],
    ]) ?>

    <h3>Изображения</h3>
    <div>
        <?=
        \powerkernel\photoswipe\Gallery::widget([
            'items' => $images
        ])
        ?>
    </div>

</div>
