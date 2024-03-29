<?php
return [
    'id' => 'ktk40priem',
    'site_online' => true,
    'default_lang' => 'ru',
    'site_name' => 'ГАПОУ КО  КТК',
    'robots_access' => 'index,follow',
    'show_author' => false,
    'theme' => [
        'site' => 'education',
        'admin' => 'education'
    ],
    'cache' => [
        'status' => false,
        'lifetime' => 60
    ],
    'optimize' => [
        'gzip_css' => true,
        'gzip_js' => false,
        'gzip_html' => false,
    ],
    'modules' => [
        'reagordi/social',
        'reagordi/geo_vk',
        'education/priem',
    ],
    'education' => [
        'priem' => [
            'key' => '74b08998f88fc2dd25c1a0b7fbd73e7e61004656',
            'company_name' => 'Госуларственное автономное профессиональное образовательное учреждение Калужской области "Калужский технический колледж"',
            'specialties' => [
                [
                    'name' => 'Отделение «Информационные технологии»',
                    'value' => [
                        [
                            'id' => 1,
                            'name' => '09.02.06 «Сетевое и системное администрирование» (базовая подготовка)»',
                            'count' => 25,
                            'class' => 1
                        ],
                        [
                            'id' => 2,
                            'name' => '09.02.06 «Сетевое и системное администрирование» (базовая подготовка)»',
                            'count' => 25,
                            'class' => 2
                        ],
                        [
                            'id' => 3,
                            'name' => '09.02.07 «Информационные системы и программирование»',
                            'count' => 50,
                            'class' => 1
                        ],
                        [
                            'id' => 4,
                            'name' => '09.02.07 «Информационные системы и программирование»',
                            'count' => 50,
                            'class' => 2
                        ],
                        [
                            'id' => 5,
                            'name' => '10.02.05 «Обеспечение информационной безопасности автоматизированных систем»',
                            'count' => 25,
                            'class' => 1
                        ],
                        [
                            'id' => 6,
                            'name' => '38.02.03 «Операционная деятельность в логистике»',
                            'count' => 25,
                            'class' => 1
                        ],
                    ]
                ],
                [
                    'name' => 'Отделение «Машиностроение»',
                    'value' => [
                        [
                            'id' => 6,
                            'name' => '15.02.08 «Технология машиностроения»',
                            'count' => 75,
                            'class' => 1
                        ],
                        [
                            'id' => 6,
                            'name' => '15.02.08 «Технология машиностроения»',
                            'count' => 25,
                            'class' => 2
                        ],
                        [
                            'id' => 7,
                            'name' => '15.02.15 «Технология металлообрабатывающего производства»',
                            'count' => 25,
                            'class' => 1
                        ],
                    ]
                ],
                [
                    'name' => 'Отделение «Учебный центр автомобилестроения»',
                    'value' => [
                        [
                            'id' => 8,
                            'name' => '15.02.03 «Сварочное производство»',
                            'count' => 25,
                            'class' => 1
                        ],
                        [
                            'id' => 9,
                            'name' => '15.02.11 «Техническая эксплуатация и обслуживание роботизированного производства»',
                            'count' => 25,
                            'class' => 1
                        ],
                        [
                            'id' => 10,
                            'name' => '23.02.05 «Эксплуатация транспортного электрооборудования и автоматики (по видам транспорта, за исключением водного)»',
                            'count' => 25,
                            'class' => 1
                        ],
                        [
                            'id' => 11,
                            'name' => '23.02.07 «Техническое обслуживание и ремонт двигателей, систем и агрегатов автомобилей»',
                            'count' => 100,
                            'class' => 1
                        ],
                    ]
                ],
            ],
            'start_date' => 1622525400, // 1622525400 // time() - 1000
            'end_date' => 1629030600,
            'min_estimation' => 3, // Минимальная оценка
            'max_estimation' => 5, // Максимальная оценка
        ]
    ],
    'reagordi' => [
        'social' => [
            'auth' => [
                'social_auth' => false
            ],
        ],
        'geo_vk' => [
            'service_key' => 'bdd28769bdd28769bdd2876978bda1ffe0bbdd2bdd28769e2b1c2e0d502f901c7b61bbb',
            'defalut' => [
                'countri' => 1,
                'region' => 1032084,
                'city' => 62
            ]
        ]
    ]
];