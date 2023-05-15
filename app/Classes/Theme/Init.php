<?php
namespace App\Classes\Theme;

use App\Classes\Theme\Skote;

class Init
{
    public static function run()
    {
        self::initPageLoader();
        self::initLayout();
        self::initHeader();
        self::initSubheader();
        self::initContent();
        self::initAside();
        self::initFooter();
    }

    private static function initLayout()
    {
        Skote::addAttr('body', 'id', 'kt_body');

        // Offcanvas directions
        Skote::addClass('body', 'quick-panel-right');
        Skote::addClass('body', 'demo-panel-right');
        Skote::addClass('body', 'offcanvas-right');
    }

    private static function initPageLoader()
    {
        if (!empty(config('layout.pages-loader.type'))) {
            Skote::addClass('body', 'pages-loading-enabled');
            Skote::addClass('body', 'pages-loading');
        }
    }

    private static function initHeader()
    {
        if (config('layout.header.self.fixed.desktop')) {
            Skote::addClass('body', 'header-fixed');
            Skote::addClass('header', 'header-fixed');
        } else {
            Skote::addClass('body', 'header-static');
        }

        if (config('layout.header.self.fixed.mobile')) {
            Skote::addClass('body', 'header-mobile-fixed');
            Skote::addClass('header-mobile', 'header-mobile-fixed');
        }

        // Menu
        if (config('layout.header.menu.self.display')) {
            Skote::addClass('header_menu', 'header-menu-layout-' . config('layout.header.menu.self.layout'));

            if (config('layout.header.menu.self.root-arrow')) {
                Skote::addClass('header_menu', 'header-menu-root-arrow');
            }
        }

        if (config('layout.header.self.width') === 'fluid') {
            Skote::addClass('header-container', 'container-fluid');
        } else {
            Skote::addClass('header-container', 'container');
        }
    }

    private static function initSubheader()
    {
        if (config('layout.subheader.display')) {
            Skote::addClass('body', 'subheader-enabled');
        } else {
            return;
        }

        $subheader_style = config('layout.subheader.style');
        $subheader_fixed = config('layout.subheader.fixed');

        // Fixed content head
        if (config('layout.subheader.fixed') && config('layout.header.self.fixed.desktop')) {
            Skote::addClass('body', 'subheader-fixed');
            $subheader_style = 'solid';
        } else {
            $subheader_fixed = false;
        }

        if ($subheader_style) {
            Skote::addClass('subheader', 'subheader-'.$subheader_style);
        }

        if (config('layout.subheader.width') == 'fluid') {
            Skote::addClass('subheader-container', 'container-fluid');
        } else {
            Skote::addClass('subheader-container', 'container');
        }

        if (config('layout.subheader.clear')) {
            Skote::addClass('subheader', 'subheader-clear');
        }
    }

    private static function initContent()
    {
        if (config('layout.content.fit-top')) {
            Skote::addClass('content', 'pt-0');
        }

        if (config('layout.content.fit-bottom')) {
            Skote::addClass('content', 'pt-0');
        }

        if (config('layout.content.width') == 'fluid') {
            Skote::addClass('content-container', 'container-fluid');
        } else {
            Skote::addClass('content-container', 'container');
        }
    }

    private static function initAside()
    {
        if (config('layout.aside.self.display') != true) {
            return;
        }

        // Enable Aside
        Skote::addClass('body', 'aside-enabled');

        // Fixed Aside
        if (config('layout.aside.self.fixed')) {
            Skote::addClass('body', 'aside-fixed');
            Skote::addClass('aside', 'aside-fixed');
        } else {
            Skote::addClass('body', 'aside-static');
        }

        // Check Aside
        if (config('layout.aside.self.display') != true) {
            return;
        }

        // Default fixed
        if (config('layout.aside.self.minimize.default')) {
            Skote::addClass('body', 'aside-minimize');
        }

        // Menu
        // Dropdown Submenu
        if (config('layout.aside.menu.dropdown') == true) {
            Skote::addClass('aside_menu', 'aside-menu-dropdown');
            Skote::addAttr('aside_menu', 'data-menu-dropdown', '1');
        }

        // Scrollable Menu
        if (config('layout.aside.menu.dropdown') != true) {
            Skote::addAttr('aside_menu', 'data-menu-scroll', "1");
        } else {
            Skote::addAttr('aside_menu', 'data-menu-scroll', "0");
        }

        if (config('layout.aside.menu.submenu.dropdown.hover-timeout')) {
            Skote::addAttr('aside_menu', 'data-menu-dropdown-timeout', config('layout.aside.menu.submenu.dropdown.hover-timeout'));
        }
    }

    private static function initFooter()
    {
        // Fixed header
        if (config('layout.footer.fixed') == true) {
            Skote::addClass('body', 'footer-fixed');
        }

        if (config('layout.footer.width') == 'fluid') {
            Skote::addClass('footer-container', 'container-fluid');
        } else {
            Skote::addClass('footer-container', 'container');
        }
    }

}
