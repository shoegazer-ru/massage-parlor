<?php

return [
    'forms' => [
        'social-link' => [
            'default' => [
                'action' => '',
                'fields' => [
                    [
                        'name' => 'caption',
                        'type' => 'string'
                    ],
                    [
                        'name' => 'value',
                        'type' => 'string'
                    ],
                ]
            ]
        ],
        'index-banner' => [
            'default' => [
                'action' => '',
                'fields' => [
                    [
                        'name' => 'caption',
                        'type' => 'string'
                    ],
                    [
                        'name' => 'files',
                        'type' => 'files'
                    ],
                ]
            ]
        ],
        'delete' => [
            'default' => [
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
    ]
];
