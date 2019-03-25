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
                    ]],
                    ['label' => Yii::t('app', 'NAV_MENU'), 'icon' => 'bars', 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_MENU_LIST'), 'url' => ['/menu/default/index']],
                    ]],
                ],
            ]
        ) ?>

    </section>

</aside>
