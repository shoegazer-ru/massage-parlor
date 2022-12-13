<?php

use App\Repositories\FieldRepository;
use App\Repositories\FileReferenceRepository;
use App\Repositories\FileRepository;
use App\Repositories\PublicationRepository;
use App\Repositories\SectionRepository;

return [
    'repositories' => [
        'file' => FileRepository::class,
        'file_reference' => FileReferenceRepository::class,
        'section' => SectionRepository::class,
        'publication' => PublicationRepository::class,
        'field' => FieldRepository::class
    ],
    'editors' => [
        'section' => [
            'default' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'caption',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'body',
                            'type' => 'texteditor'
                        ],
                        [
                            'name' => 'files',
                            'type' => 'files'
                        ],
                    ]
                ]
            ],
            'create' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'caption',
                            'type' => 'string'
                        ],
                    ]
                ]
            ]
        ],
        'publication' => [
            'default' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'caption',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'date',
                            'type' => 'datepicker'
                        ],
                        [
                            'name' => 'body',
                            'type' => 'texteditor'
                        ],
                        [
                            'name' => 'files',
                            'type' => 'files'
                        ],
                    ]
                ]
            ],
            'create' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'caption',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'date',
                            'type' => 'datepicker'
                        ],
                    ]
                ]
            ]
        ],
        'file' => [
            'default' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'name',
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ],
        'file_reference' => [
            'default' => [
                'form' => [
                    'action' => '',
                    'fields' => [
                        [
                            'name' => 'file_id',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'model_name',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'model_id',
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'deletors' => [
        'default' => [
            'form' => [
                'action' => '',
                'fields' => [
                    [
                        'name' => 'delete',
                        'type' => 'hidden',
                        'value' => 1
                    ]
                ]
            ]
        ]
    ],
    'actions' => [
        'default' => [
            'edit' => [
                'route' => ['model.edit'],
                'routeParams' => ['id' => 'modelId']
            ],
            'delete' => [
                'route' => ['model.delete'],
                'routeParams' => ['id' => 'modelId']
            ]
        ],
        'section' => [
            'edit',
            'subsections' => [
                'route' => ['model.list', 'modelName' => 'section'],
                'routeParams' => ['id' => 'parent_id']
            ],
            'publications' => [
                'route' => ['model.list', 'modelName' => 'publication'],
                'routeParams' => ['id' => 'section_id']
            ],
            'delete',
        ]
    ]
];
