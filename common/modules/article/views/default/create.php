<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\article\models\Article */
/* @var $initialPreview array - array of images' links for preview*/
/* @var $initialPreviewConfig array - array of full images' information for preview*/

$this->title = Yii::t('art_mod', 'ARTICLE_CREATE');
$this->params['breadcrumbs'][] = ['label' => Yii::t('art_mod', 'ARTICLE_PAGE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
        'model' => $model,
        'tags' => $tags,
        'currentTags' => $currentTags,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ])
    ?>
    
</div>
