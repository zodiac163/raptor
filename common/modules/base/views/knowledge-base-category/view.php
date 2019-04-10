<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\base\models\KnowledgeBaseCategory;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\modules\base\models\KnowledgeBaseCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_mod', 'KNOWLEDGE_BASE_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="knowledge-base-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_mod', 'UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base_mod', 'DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base_mod', 'SURE_TO_DELETE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->parent_id === 0) {
                        $parent = Yii::t('app', 'ROOT');
                    } else {
                        $parentCategory = KnowledgeBaseCategory::findOne(['id' => $data->parent_id]);
                        if ($parentCategory) {
                            $parent = Html::a($parentCategory->title, Url::to(['/base/knowledge-base-category/view', 'id' => $parentCategory->id ]));
                        } else {
                            $parent = "<span class='has-error'>" . Yii::t('base_mod', 'PARENT_ERROR') . "</span>";
                        }
                    }
                    return $parent;
                }
            ],
            'level',
            'path',
            'alias',
            'title',
            [
                'attribute' => 'description',
                'value' => function ($data) {
                    return $data->description ? $data->description : null;
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
            [
                'attribute' => 'params',
                'value' => function ($data) {
                    return $data->params ? $data->params : null;
                }
            ],
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
                        $created_user_id = "<span class='has-error'>" . Yii::t('base_mod', 'USER_ERROR') . "</span>";
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
                            $modified_user_id = "<span class='has-error'>" . Yii::t('base_mod', 'USER_ERROR') . "</span>";
                        }
                    } else {
                        $modified_user_id = "<span class='text-yellow'>" . Yii::t('base_mod', 'NOT_MODIFY') . "</span>";
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

</div>
