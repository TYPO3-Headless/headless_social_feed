<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Headless PxaSocialFeed',
    'description' => 'This extension provides integration with social feeds to output content from TYPO3 in JSON format.',
    'state' => 'stable',
    'author' => 'Patryk Miedziaszczyk',
    'author_email' => 'extensions@macopedia.com',
    'category' => 'fe',
    'internal' => '',
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.0.99',
            'frontend' => '9.5.0-10.0.99'
        ],
        'conflicts' => [],
        'suggests' => [
            'headless' => '2.0.0-2.9.9'
        ]
    ],
];
