<?php

return [
	'theme_manager' => [
        'default_theme'     => 'default',
        'admin_theme'       => 'admin',
        'theme_path'        => './public/themes/',
        'bootstrap'         => true,
        'bootswatch_theme'  => null,
        'font_awesome'      => true,
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