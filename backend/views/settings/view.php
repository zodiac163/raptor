<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = Yii::t('app', 'NAV_SETTINGS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NAV_SETTINGS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'UPDATE'), ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sys_title',
            'sys_state',
            'sys_slogan',
            'sys_description',
            'sys_logo',
            'sys_footer',
            'adm_mail',
            'seo_description',
            'seo_keywords',
        ],
    ]) ?>

</div>
