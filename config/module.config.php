<?php

use UthandoThemeManager\Controller\SettingsController;
use UthandoThemeManager\Mapper\WidgetGroupMapper;
use UthandoThemeManager\Mapper\WidgetMapper;
use UthandoThemeManager\Model\WidgetGroupModel;
use UthandoThemeManager\Model\WidgetModel;
use UthandoThemeManager\Options\ThemeOptions;
use UthandoThemeManager\Service\ThemeOptionsFactory;
use UthandoThemeManager\View\BootStrapTheme;
use UthandoThemeManager\View\SocialLinks;
use UthandoThemeManager\View\ThemeOptionsHelper;
use UthandoThemeManager\View\ThemePath;

return [
    'asset_manager' => [
        'resolver_configs' => [
            'collections' => [
                'js/uthando.js' => [
                ],
                'css/uthando.css' => [
                    'default/assets/css/styles.css',
                ],
            ],
            'paths' => [
                'ThemeManager' => './themes',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            SettingsController::class => SettingsController::class
        ],
    ],
    'uthando_mappers' => [
        'invokables' => [
            WidgetMapper::class         => WidgetMapper::class,
            WidgetGroupMapper::class    => WidgetGroupMapper::class,
        ]
    ],
    'uthando_models' => [
        'invokables' => [
            WidgetModel::class          => WidgetModel::class,
            WidgetGroupMapper::class    => WidgetGroupModel::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            ThemeOptions::class => ThemeOptionsFactory::class
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'Bootstrap'      => BootStrapTheme::class,
            'SocialLinks'    => SocialLinks::class,
            'ThemeOptions'   => ThemeOptionsHelper::class,
            'ThemePath'      => ThemePath::class,
        ],
    ],
];
