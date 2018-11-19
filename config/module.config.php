<?php

use UthandoThemeManager\Controller\SettingsController;
use UthandoThemeManager\Controller\WidgetController;
use UthandoThemeManager\Controller\WidgetGroupController;
use UthandoThemeManager\Options\ThemeOptions;
use UthandoThemeManager\Service\ThemeOptionsFactory;
use UthandoThemeManager\Service\WidgetGroupManager;
use UthandoThemeManager\Service\WidgetManager;
use UthandoThemeManager\View\BootStrapTheme;
use UthandoThemeManager\View\SocialLinks;
use UthandoThemeManager\View\ThemeOptionsHelper;
use UthandoThemeManager\View\ThemePath;
use UthandoThemeManager\View\WidgetHelper;
use UthandoThemeManager\Widget\Html;
use UthandoThemeManager\Widget\Content;
use UthandoThemeManager\Widget\LayoutRow;
use UthandoThemeManager\Widget\Partial;

return [
    'controllers' => [
        'invokables' => [
            SettingsController::class       => SettingsController::class,
            WidgetController::class         => WidgetController::class,
            WidgetGroupController::class    => WidgetGroupController::class,
        ],
    ],
    'uthando_services' => [
        'invokables' => [
            WidgetManager::class        => WidgetManager::class,
            WidgetGroupManager::class   => WidgetGroupManager::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            ThemeOptions::class => ThemeOptionsFactory::class
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'bootstrap'                 => BootStrapTheme::class,
            'socialLinks'               => SocialLinks::class,
            'themeOptions'              => ThemeOptionsHelper::class,
            'themePath'                 => ThemePath::class,
            'widget'                    => WidgetHelper::class,
        ],
        'invokables' => [
            BootStrapTheme::class       => BootStrapTheme::class,
            SocialLinks::class          => SocialLinks::class,
            ThemeOptionsHelper::class   => ThemeOptionsHelper::class,
            ThemePath::class            => ThemePath::class,
            WidgetHelper::class         => WidgetHelper::class,

            Html::class                 => Html::class,
            Content::class              => Content::class,
            LayoutRow::class            => LayoutRow::class,
            Partial::class              => Partial::class,
        ],
    ],
    'view_manager'  => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
];
