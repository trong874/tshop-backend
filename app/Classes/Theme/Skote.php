<?php
namespace App\Classes\Theme;

class Skote
{
    public static $attrs;
    public static $classes;

    public static function addAttr($scope, $name, $value)
    {
        self::$attrs[$scope][$name] = $value;
    }

    public static function addClass($scope, $class)
    {
        self::$classes[$scope][] = $class;
    }

    public static function printAttrs($scope)
    {
        $attrs = [];

        if (isset(self::$attrs[$scope]) && !empty(self::$attrs[$scope])) {
            foreach (self::$attrs[$scope] as $name => $value) {
                $attrs[] = $name . '="' . $value . '"';
            }
            echo ' ' . implode(' ', $attrs) . ' ';
        }
        echo '';
    }

    public static function printClasses($scope, $full = true)
    {
        if ($scope == 'body') {
            self::$classes[$scope][] = 'pages-loading';
        }

        if (isset(self::$classes[$scope]) && !empty(self::$classes[$scope])) {
            $classes = implode(' ', self::$classes[$scope]);
            if ($full) {
                echo ' class="' . $classes . '" ';
            } else {
                echo ' ' . $classes . ' ';
            }
        } else {
            echo '';
        }
    }

    /**
     * Prints Google Fonts
     */
    public static function getGoogleFontsInclude()
    {
        if (config('layout.resources.fonts.google.families')) {
            $fonts = config('layout.resources.fonts.google.families');
            echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' . implode('|', $fonts) . '">';
        }
        echo '';
    }

    /**
     * Walk recursive array with callback
     * @param array    $array
     * @param callable $callback
     * @return array
     */
    public static function arrayWalkCallback(array &$array, callable $callback)
    {
        foreach ($array as $k => &$v) {
            if (is_array($v)) {
                $callback($k, $v, $array);
                self::arrayWalkCallback($v, $callback);
            }
        }

        return $array;
    }

    /**
     * Initialize theme CSS files
     */
    public static function initThemes()
    {
        $themes = [];

        $themes[] = 'css/themes/layout/header/base/'.config('layout.header.self.theme').'.css';
        $themes[] = 'css/themes/layout/header/menu/'.config('layout.header.menu.desktop.submenu.theme').'.css';
        $themes[] = 'css/themes/layout/aside/'.config('layout.aside.self.theme').'.css';

        if (config('layout.aside.self.display')) {
            $themes[] = 'css/themes/layout/brand/'.config('layout.brand.self.theme').'.css';
        } else {
            $themes[] = 'css/themes/layout/brand/'.config('layout.header.self.theme').'.css';
        }

        return $themes;
    }

}
