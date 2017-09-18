<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoThemeManager\Controller\SettingsController::class   => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                \UthandoThemeManager\Controller\SettingsController::class,
            ],
        ],
    ],
];
