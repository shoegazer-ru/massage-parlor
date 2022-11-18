<?php

return [
    'dashboard' => [
        'menu' => [
            'sections' => [
                'route' => ['model.list', 'modelName' => 'section']
            ],
            'socialLinks' => [
                'route' => ['fields.list', 'fieldName' => 'social-link']
            ],
            'indexBanners' => [
                'route' => ['fields.list', 'fieldName' => 'index-banner']
            ]
        ]
    ],
    'breadcrumbs' => [
        'models' => [
            'publication' => [
                'context' => [
                    'model' => 'section',
                    'field' => 'section_id'
                ]
            ]
        ]
    ]
];
