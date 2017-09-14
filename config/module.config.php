<?php

return [
    'asset_manager' => [
        'resolver_configs' => [
            'collections' => [
                'js/uthando.js' => [
                    'site.js'
                ],
                'css/uthando.css' => [
                    'css/styles.css',
                    'css/tweet-feed.css',
                ],
            ],
            'paths' => [
                'ThemeManager' => './themes',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UthandoThemeManager\Options\ThemeOptions' => 'UthandoThemeManager\Service\ThemeOptionsFactory',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'Bootstrap'      => 'UthandoThemeManager\View\BootStrapTheme',
            'SocialLinks'    => 'UthandoThemeManager\View\SocialLinks',
            'ThemeOptions'   => 'UthandoThemeManager\View\ThemeOptions',
            'ThemePath'      => 'UthandoThemeManager\View\ThemePath',
        ],
    ],
];