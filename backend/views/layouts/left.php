<?php
use common\modules\menu\models\Menu;
$menu = Menu::find()->all();
$menuList[] = ['label' => Yii::t('app', 'NAV_MENU_LIST'), 'url' => ['/menu/default/index']];
foreach ($menu as $item) {
    $menuList[] = ['label' => $item->title, 'icon' => 'ellipsis-v', 'url' => ['/menu/menu-links/index', 'menu' => $item->id]];
}
//echo "<pre>"; var_dump($menuList); exit;
 ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => Yii::t('app', 'NAV_MENU'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'NAV_USERS'), 'icon' => 'user-o', 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_USERS_LIST'), 'url' => ['/user']],
                        ['label' => Yii::t('app', 'NAV_USERS_ROLES'), 'url' => ['/permit/access/role']],
                        ['label' => Yii::t('app', 'NAV_USERS_ACCESS'), 'url' => ['/permit/access/permission']],
                    ]],
                    ['label' => Yii::t('app', 'NAV_MATERIAL'), 'icon' => 'folder-open-o', 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_MATERIAL_CATEGORY'), 'url' => ['/category/default/index']],
                        ['label' => Yii::t('app', 'NAV_MATERIAL_ARTICLE'), 'url' => ['/article/default/index']],
                        ['label' => Yii::t('app', 'NAV_MATERIAL_TAGS'), 'url' => ['/article/tag/index']],
                    ]],
                    ['label' => Yii::t('app', 'NAV_CATALOG'), 'icon' => 'folder-open-o', 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_PRODUCTS_CATEGORY'), 'url' => ['/product/product-category/index']],
                        ['label' => Yii::t('app', 'NAV_PRODUCTS_PRODUCT'), 'url' => ['/product/product/index']],
                        ['label' => Yii::t('app', 'NAV_PRODUCTS_MANUFACTURERS'), 'url' => ['/product/manufacturer/index']],
                    ]],
                    ['label' => Yii::t('app', 'NAV_BASE'), 'icon' => 'folder-open-o', 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_BASE_CATEGORY'), 'url' => ['/base/knowledge-base-category/index']],
                        ['label' => Yii::t('app', 'NAV_BASE_ARTICLES'), 'url' => ['/base/knowledge-base/index']],
                        ['label' => Yii::t('app', 'NAV_BASE_JOURNAL'), 'url' => ['/base/journal/index']],
                    ]],
                    ['label' => Yii::t('app', 'NAV_MENU'), 'icon' => 'bars', 'url' => '#', 'items' =>
                        $menuList
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
