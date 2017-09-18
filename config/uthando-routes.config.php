<?php

use UthandoThemeManager\Controller\SettingsController;
use UthandoThemeManager\Controller\WidgetController;
use UthandoThemeManager\Controller\WidgetGroupController;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'theme-manager' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/theme-manager',
                            'defaults' => [
                                '__NAMESPACE__' => 'UthandoThemeManager\Controller',
                                'controller'    => SettingsController::class,
                                'action'        => 'index',
                                'force-ssl'     => 'ssl'
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'widget' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/widget',
                                    'defaults' => [
                                        'controller' => WidgetController::class,
                                        'action' => 'index',
                                        'force-ssl' => 'ssl'
                                    ]
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'edit' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'         => '/[:action[/id/[:id]]]',
                                            'constraints'   => [
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'		=> '\d+'
                                            ],
                                            'defaults'      => [
                                                'action'        => 'edit',
                                                'force-ssl'     => 'ssl'
                                            ],
                                        ],
                                        'may_terminate' => true,
                                    ],
                                    'page' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'         => '/page/[:page]',
                                            'constraints'   => [
                                                'page' => '\d+'
                                            ],
                                            'defaults'      => [
                                                'action'        => 'list',
                                                'page'          => 1,
                                                'force-ssl'     => 'ssl'
                                            ],
                                        ],
                                        'may_terminate' => true,
                                    ],
                                ],
                            ],
                            'widget-group' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/widget-group',
                                    'defaults' => [
                                        'controller' => WidgetGroupController::class,
                                        'action' => 'index',
                                        'force-ssl' => 'ssl'
                                    ]
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'edit' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'         => '/[:action[/id/[:id]]]',
                                            'constraints'   => [
                                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id'		=> '\d+'
                                            ],
                                            'defaults'      => [
                                                'action'        => 'edit',
                                                'force-ssl'     => 'ssl'
                                            ],
                                        ],
                                        'may_terminate' => true,
                                    ],
                                    'page' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'         => '/page/[:page]',
                                            'constraints'   => [
                                                'page' => '\d+'
                                            ],
                                            'defaults'      => [
                                                'action'        => 'list',
                                                'page'          => 1,
                                                'force-ssl'     => 'ssl'
                                            ],
                                        ],
                                        'may_terminate' => true,
                                    ],
                                ],
                            ],
                            'settings' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/settings',
                                    'defaults' => [
                                        'controller' => SettingsController::class,
                                        'action' => 'index',
                                        'force-ssl' => 'ssl'
                                    ]
                                ],
                                'may_terminate' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
