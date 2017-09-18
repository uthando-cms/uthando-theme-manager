<?php

use UthandoThemeManager\Controller\SettingsController;
use UthandoThemeManager\Controller\WidgetController;
use UthandoThemeManager\Controller\WidgetGroupController;

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                SettingsController::class       => ['action' => 'all'],
                                WidgetController::class         => ['action' => 'all'],
                                WidgetGroupController::class    => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                SettingsController::class,
                WidgetController::class,
                WidgetGroupController::class,
            ],
        ],
    ],
];
