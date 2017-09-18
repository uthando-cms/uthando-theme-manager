<?php

use UthandoThemeManager\Controller\SettingsController;
use UthandoThemeManager\Controller\WidgetController;
use UthandoThemeManager\Controller\WidgetGroupController;
use UthandoThemeManager\Form\SocialLinksFieldSet;
use UthandoThemeManager\Form\ThemeManagerSettingsForm;
use UthandoThemeManager\Form\WidgetForm;
use UthandoThemeManager\Form\WidgetGroupForm;
use UthandoThemeManager\Hydrator\WidgetGroupHydrator;
use UthandoThemeManager\Hydrator\WidgetHydrator;
use UthandoThemeManager\InputFilter\WidgetGroupInputFilter;
use UthandoThemeManager\InputFilter\WidgetInputFilter;
use UthandoThemeManager\Mapper\WidgetGroupMapper;
use UthandoThemeManager\Mapper\WidgetMapper;
use UthandoThemeManager\Model\WidgetGroupModel;
use UthandoThemeManager\Model\WidgetModel;
use UthandoThemeManager\Options\ThemeOptions;
use UthandoThemeManager\Service\ThemeOptionsFactory;
use UthandoThemeManager\Service\WidgetGroupManager;
use UthandoThemeManager\Service\WidgetManager;
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
            SettingsController::class       => SettingsController::class,
            WidgetController::class         => WidgetController::class,
            WidgetGroupController::class    => WidgetGroupController::class,
        ],
    ],
    'form_elements' => [
        'invokables' => [
            SocialLinksFieldSet::class          => SocialLinksFieldSet::class,
            ThemeManagerSettingsForm::class     => ThemeManagerSettingsForm::class,
            WidgetForm::class                   => WidgetForm::class,
            WidgetGroupForm::class              => WidgetGroupForm::class
        ],
    ],
    'hydrators' => [
        'invokables' => [
            WidgetHydrator::class       => WidgetHydrator::class,
            WidgetGroupHydrator::class  => WidgetGroupHydrator::class,
        ],
    ],
    'input_filters' => [
        'invokables' => [
            WidgetInputFilter::class        => WidgetInputFilter::class,
            WidgetGroupInputFilter::class   => WidgetGroupInputFilter::class,
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
        'invokables' => [
            'Bootstrap'      => BootStrapTheme::class,
            'SocialLinks'    => SocialLinks::class,
            'ThemeOptions'   => ThemeOptionsHelper::class,
            'ThemePath'      => ThemePath::class,
        ],
    ],
    'view_manager'  => [
        'template_map' => include __DIR__ . '/../template_map.php'
    ],
];
