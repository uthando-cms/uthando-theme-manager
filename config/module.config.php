<?php

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
            \UthandoThemeManager\Controller\Settings::class => \UthandoThemeManager\Controller\Settings::class
        ],
    ],
    'uthando_models' => [
        'invokables' => [
            'UthandoThemeManagerWidget'         => \UthandoThemeManager\Model\Widget::class,
            'UthandoThemeManagerWidgetGroup'    => \UthandoThemeManager\Model\WidgetGroup::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            \UthandoThemeManager\Options\ThemeOptions::class => \UthandoThemeManager\Service\ThemeOptionsFactory::class
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'Bootstrap'      => \UthandoThemeManager\View\BootStrapTheme::class,
            'SocialLinks'    => \UthandoThemeManager\View\SocialLinks::class,
            'ThemeOptions'   => \UthandoThemeManager\View\ThemeOptionsHelper::class,
            'ThemePath'      => \UthandoThemeManager\View\ThemePath::class,
        ],
    ],
];