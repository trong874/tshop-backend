<?php
// Aside menu
return [
    'items' => [
        [
            'section' => 'Menu',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'bx bx-home-circle',
            'pages' => '/',
        ],
        [
            'title' => 'Quản lí đơn hàng',
            'icon' => 'bx bx-cart',
            'new-tab' => false,
            'submenu' => [
                [
                    'title' => 'Users',
                    'pages' => '/user',
                    'new-tab' => true,
                ],
            ]
        ],
        [
            'section' => 'Sản phẩm',
        ],
        [
            'title' => 'Quản lí sản phẩm',
            'icon' => 'bx bxs-t-shirt',
            'pages' => '/products',
        ],
        [
            'title' => 'Danh mục sản phẩm',
            'icon' => 'bx bx-customize',
            'pages' => '/categories',
        ],
        [
            'section' => 'Tài khoản.',
        ],
        [
            'title' => 'Quản lý tài khoản.',
            'icon' => 'bx bx-user-circle',
            'pages'=>'/accounts',
        ],
        [
            'section' => 'Phân quyền.',
        ],
        [
            'title' => 'Nhóm vài trò.',
            'icon' => 'bx bx-group',
            'pages'=>'roles',
        ],
        [
            'title' => 'Danh sách quyền.',
            'icon' => 'bx bx-shield-quarter',
            'pages'=>'permissions',
        ],
    ]

];
