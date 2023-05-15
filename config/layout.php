<?php

return [

    // Self
    'self' => [
        'layout' => 'default', // blank, default
        'rtl' => false, // true, false
    ],

    // Base Layout
    'js' => [
        'breakpoints' => [
            'sm' => 576,
            'md' => 768,
            'lg' => 992,
            'xl' => 1200,
            'xxl' => 1200
        ],
        'font-family' => 'Poppins'
    ],

    // Page loader
    'page-loader' => [
        'type' => '' // default, spinner-message, spinner-logo
    ],

    // Header
    'header' => [
        'self' => [
            'display' => true,
            'width' => 'fluid', // fixed, fluid
            'theme' => 'light', // light, dark
            'fixed' => [
                'desktop' => true,
                'mobile' => true
            ]
        ],

        'menu' => [
            'self' => [
                'display' => true,
                'layout'  => 'default', // tab, default
                'root-arrow' => false, // true, false
            ],

            'desktop' => [
                'arrow' => true,
                'toggle' => 'click',
                'submenu' => [
                    'theme' => 'light',
                    'arrow' => true,
                ]
            ],

            'mobile' => [
                'submenu' => [
                    'theme' => 'dark',
                    'accordion' => true
                ],
            ],
        ]
    ],

    // Subheader
    'subheader' => [
        'display' => true,
        'displayDesc' => true,
        'layout' => 'subheader-v1',
        'fixed' => true,
        'width' => 'fluid', // fixed, fluid
        'clear' => false,
        'layouts' => [
            'subheader-v1' => 'Subheader v1',
            'subheader-v2' => 'Subheader v2',
            'subheader-v3' => 'Subheader v3',
            'subheader-v4' => 'Subheader v4',
        ],
        'style' => 'solid' // transparent, solid. can be transparent only if 'fixed' => false
    ],

    // Content
    'content' => [
        'width' => 'fixed', // fluid, fixed
        'extended' => false, // true, false
    ],

    // Brand
    'brand' => [
        'self' => [
            'theme' => 'dark' // light, dark
        ]
    ],

    // Aside
    'aside' => [
        'self' => [
            'theme' => 'dark', // light, dark
            'display' => true,
            'fixed' => true,
            'minimize' => [
                'toggle' => true, // allow toggle
                'default' => false // default state
            ]
        ],

        'menu' => [
            'dropdown' => false, // ok
            'scroll' => false, // ok
            'submenu' => [
                'accordion' => true, // true, false
                'dropdown' => [
                    'arrow' => true,
                    'hover-timeout' => 500 // in milliseconds
                ]
            ]
        ]
    ],

    // Footer
    'footer' => [
        'width' => 'fluid', // fluid, fixed
        'fixed' => false
    ],

    // Extras
    'extras' => [

        // Search
        'search' => [
            'display' => true,
            'layout' => 'dropdown', // offcanvas, dropdown
            'offcanvas' => [
                'direction' => 'right'
            ],
        ],

        // Notifications
        'notifications' => [
            'display' => true,
            'layout' => 'dropdown', // offcanvas, dropdown
            'dropdown' => [
                'style' => 'dark' // light|dark
            ],
            'offcanvas' => [
                'direction' => 'right'
            ]
        ],

        // Quick Actions
        'quick-actions' => [
            'display' => true,
            'layout' => 'dropdown', // offcanvas, dropdown
            'dropdown' => [
                'style' => 'dark' // light|dark
            ],
            'offcanvas' => [
                'direction' => 'right'
            ]
        ],

        // User
        'user' => [
            'display' => true,
            'layout' => 'offcanvas', // offcanvas, dropdown
            'dropdown' => [
                'style' => 'dark' // light|dark
            ],
            'offcanvas' => [
                'direction' => 'right'
            ]
        ],

        // Languages
        'languages' => [
            'display' => true
        ],

        // Cart
        'cart' => [
            'display' => true,
            'dropdown' => [
                'style' => 'dark' // light|dark
            ]
        ],

        // Quick Panel
        'quick-panel' => [
            'display' => true,
            'offcanvas' => [
                'direction' => 'right'
            ]
        ],

        // Chat
        'chat' => [
            'display' => true,
        ],

        // Page Toolbar
        'toolbar' => [
            'display' => true
        ],

        // Scrolltop
        'scrolltop' => [
            'display' => true
        ]
    ],

    // Demo Assets
    'resources' => [
        'favicon' => 'assets/images/favicon.ico',
        'fonts' => [
            'google' => [
                'families' => [
                    'Nunito+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700'
                ]
            ]
        ],
        'css' => [
            'assets/css/bootstrap.min.css',
            'assets/css/icons.min.css',
            'assets/css/app.min.css',
            'assets/css/custom.css'
        ],
        'js' => [
            'assets/libs/jquery/jquery.min.js',
            'assets/libs/bootstrap/js/bootstrap.bundle.min.js',
            'assets/libs/metismenu/metisMenu.min.js',
            'assets/libs/simplebar/simplebar.min.js',
            'assets/libs/node-waves/waves.min.js',
            'assets/libs/moment/min/moment.min.js',
            'assets/js/app.js',
            'assets/js/menu-aside-filter.js',
            'assets/js/utils.js',
            'assets/js/globals.js',
        ],
    ],

];
