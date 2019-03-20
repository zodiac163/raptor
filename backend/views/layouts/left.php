<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => Yii::t('app', 'NAV_MENU'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'NAV_USERS'), 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_USERS_ROLES'), 'icon' => 'file-code-o', 'url' => ['/permit/access/role']],
                        ['label' => Yii::t('app', 'NAV_USERS_ACCESS'), 'icon' => 'file-code-o', 'url' => ['/permit/access/permission']],
                    ]],
                    ['label' => Yii::t('app', 'NAV_MATERIAL'), 'url' => '#', 'items' => [
                        ['label' => Yii::t('app', 'NAV_MATERIAL_CATEGORY'), 'icon' => 'file-code-o', 'url' => ['/category']],
                    ]],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
