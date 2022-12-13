<?php

return [
    'messages' => [
        'model' => [
            'saved' => 'Данные успешно сохранены',
            'deleted' => 'Данные удалены',
            'not-found' => 'Объект не найден',
            'section' => [
                'not-found' => 'Раздел не найден'
            ],
            'context' => [
                'not-found' => 'Не найдена контекстная модель'
            ]
        ]
    ],
    'links' => [
        'model' => [
            'list' => 'К списку моделей'
        ]
    ],
    'forms' => [
        'fields' => [
            'save' => [
                'label' => 'Сохранить'
            ],
            'delete' => [
                'label' => 'Удалить'
            ]
        ]
    ],
    'models' => [
        'section' => [
            'name' => 'Раздел',
            'name-plural' => 'Разделы',
            'editors' => [
                'default' => [
                    'title' => 'Редактор раздела',
                    'fields' => [
                        'caption' => [
                            'label' => 'Название'
                        ],
                        'body' => [
                            'label' => 'Описание'
                        ],
                        'files' => [
                            'label' => 'Файлы'
                        ]
                    ]
                ]
            ],
            'deletors' => [
                'default' => [
                    'title' => 'Удаление раздела',
                    'note' => 'Подтвердите удаление раздела ":name"'
                ]
            ]
        ],
        'publication' => [
            'name' => 'Статья',
            'name-plural' => 'Статьи',
            'editors' => [
                'default' => [
                    'title' => 'Редактор статьи',
                    'fields' => [
                        'caption' => [
                            'label' => 'Название'
                        ],
                        'date' => [
                            'label' => 'Дата'
                        ],
                        'body' => [
                            'label' => 'Описание'
                        ],
                        'files' => [
                            'label' => 'Файлы'
                        ]
                    ]
                ]
            ],
            'deletors' => [
                'default' => [
                    'title' => 'Удаление статьи',
                    'note' => 'Подтвердите удаление статьи ":name"'
                ]
            ]
        ],
        'field' => [
            'name' => 'Поле',
            'name-plural' => 'Поля',
        ],
        'file' => [
            'name' => 'Файл',
            'name-plural' => 'Файлы',
            'editors' => [
                'default' => [
                    'title' => 'Редактор файла',
                    'fields' => [
                        'name' => [
                            'label' => 'Название'
                        ]
                    ]
                ]
            ]
        ],
        'file_reference' => [
            'name' => 'Связь файла и модели',
            'name-plural' => 'Связи файлов и моделей',
            'editors' => [
                'default' => [
                    'title' => 'Редактор связи файла и модели',
                    'fields' => [
                        'file_id' => [
                            'label' => 'ID файла'
                        ],
                        'model_name' => [
                            'label' => 'Модель'
                        ],
                        'model_id' => [
                            'label' => 'ID модели'
                        ]
                    ]
                ]
            ]
        ],
    ],
    'fields' => [
        'social-link' => [
            'name' => 'Ссылка на соцсеть',
            'name-plural' => 'Ссылки на соцсети',
            'editors' => [
                'default' => [
                    'fields' => [
                        'caption' => [
                            'label' => 'Название'
                        ],
                        'value' => [
                            'label' => 'Ссылка'
                        ]
                    ]
                ]
            ]
        ],
        'index-banner' => [
            'name' => 'Баннер на главной',
            'name-plural' => 'Баннеры на главной',
            'editors' => [
                'default' => [
                    'fields' => [
                        'caption' => [
                            'label' => 'Название'
                        ],
                        'files' => [
                            'label' => 'Файлы'
                        ]
                    ]
                ]
            ]
        ],
        'delete' => [
            'default' => [
                'note' => 'Подтвердите удаление ":name"'
            ]
        ]
    ],
    'breadcrumbs' => [
        'main' => 'Панель администратора',
        'editor' => 'Редакировать',
        'creator' => 'Создать',
        'deletor' => 'Удалить',
        'auth' => 'Авторизация'
    ],
    'dashboard' => [
        'menu' => [
            'sections' => 'Разделы',
            'publications' => 'Статьи',
            'socialLinks' => 'Ссылки на соцсети',
            'indexBanners' => 'Баннеры на главной'
        ]
    ],
    'actions' => [
        'create' => 'Добавить',
        'edit' => 'Редактировать',
        'delete' => 'Удалить',
        'publications' => 'Публикации',
        'subsections' => 'Подразделы'
    ]
];
