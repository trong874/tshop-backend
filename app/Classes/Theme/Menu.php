<?php

namespace App\Classes\Theme;

use App\Classes\Theme\Skote;
use Illuminate\Support\Facades\Route;

class Menu
{

    public static function renderVerMenu($item, $parent = null, $rec = 0, $singleItem = false)
    {
        self::checkRecursion($rec);
        if (!$item) {
            return 'Menu cấu hình sai';
        }
        if (isset($item['section'])) {
            echo '<li class="menu-title">' . $item['section'] . '</li>';
        } elseif (isset($item['title'])) {
            $has_permission = !isset($item['permission']) || (auth()->check() && auth()->user()->hasPermissionTo($item['permission']));
            $has_role_admin = auth()->user()->hasRole('admin') ?? false;

            if ($has_permission || $has_role_admin) {
                $item_class = '';
                if (self::isActiveVerMenuItem($item, request()->path())) {
                    $item_class .= 'mm-active';
                }

                echo '<li class="' . $item_class . '">';

                $url = '#';
                if (isset($item['pages'])) {
                    $url = url($item['pages']);
                }

                $target = '';
                if (isset($item['new-tab']) && $item['new-tab'] == true) {
                    $target = 'target="_blank"';
                }

                echo '<a ' . $target . ' href="' . $url . '" class="' . (isset($item['submenu']) ? 'has-arrow waves-effect' : '') . '">';

                // Menu icon
                if (config('layout.aside.menu.hide-root-icons') !== true && isset($item['icon']) && !empty($item['icon'])) {
                    self::renderIcon($item['icon']);
                } else {
                    self::renderIcon('bx bx-chevron-right');
                }

                // Badge
                echo '<span class="menu-text">' . $item['title'] . '</span>';
                if (isset($item['label'])) {
                    echo '<span class="menu-badge"><span class="label ' . $item['label']['type'] . '">' . $item['label']['value'] . '</span></span>';
                }

                if ($singleItem == true) {
                    if (isset($item['parent'])) {
                        echo '</span>';
                    } else {
                        echo '</a>';
                    }

                    echo '</li>';
                    return;
                }

                if (isset($item['parent'])) {
                    echo '</span>';
                } else {
                    echo '</a>';
                }

                if (isset($item['submenu'])) {
                    echo '<ul class="sub-menu mm-collapse">';

                    foreach ($item['submenu'] as $submenu_item) {
                        self::renderVerMenu($submenu_item, $item, $rec++);
                    }

                    if (isset($item['scroll']) || isset($item['custom-class']) && $item['custom-class'] === 'menu-item-submenu-stretch') {
                        echo '</div>';
                    }
                    echo '</ul>';
                }

                echo '</li>';
            }
        }
        else {
            foreach ($item as $each) {
                self::renderVerMenu($each, $parent, $rec++);
            }
        }
    }

    // Check for active Vertical Menu item
    public static function isActiveVerMenuItem($item, $page, $rec = 0): bool
    {
        self::checkRecursion($rec);

        if (isset($item['pages']) && $item['pages'] == $page) {
            return true;
        }

        if (is_array($item)) {
            foreach ($item as $each) {
                if (self::isActiveVerMenuItem($each, $page, $rec++)) {
                    return true;
                }
            }
        }
        return false;
    }

    // Checks recursion depth
    public static function checkRecursion($rec, $max = 1000)
    {
        if ($rec > $max) {
            echo 'Too many recursions!!!';
            exit;
        }
    }

    // Render icon or bullet
    public static function renderIcon($icon)
    {
        echo '<i class="' . $icon . '"></i>';
    }

}
