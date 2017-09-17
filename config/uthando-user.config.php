<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoThemeManager\Controller\Settings::class   => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                \UthandoThemeManager\Controller\Settings::class,
            ],
        ],
    ],
];
