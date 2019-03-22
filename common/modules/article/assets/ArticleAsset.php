<?php
/**
 * Created by PhpStorm.
 * User: Zodiac
 * Date: 22.03.2019
 * Time: 14:21
 */

namespace common\modules\article\assets;

use yii\web\AssetBundle;

class ArticleAsset extends AssetBundle
{
    public $sourcePath = '@moduleArticle/web/';
    //public $css = ['css/style_ip.css'];
    public $js = ['js/image.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
