<?php
defined('TYPO3_MODE') or die();

return (function() {
    return [
        'ctrl' => [
            'title' => 'Configuration',
            'label' => 'name',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'default_sortby' => 'crdate DESC',
            'delete' => 'deleted',
            'enablecolumns' => [
                'disabled' => 'hidden'
            ],
            'searchFields' => 'name, token, app_id, app_secret',
            'rootLevel' => 1
        ],
        'columns' => [
            'hidden' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                'config' => [
                    'type' => 'check',
                ],
            ],
            'name' => [
                'exclude' => 1,
                'label' => 'Name',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'app_id' => [
                'exclude' => 1,
                'label' => 'App ID',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'app_secret' => [
                'exclude' => 1,
                'label' => 'App Secret',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'max_items' => [
                'exclude' => 1,
                'label' => 'Max Items',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'storage' => [
                'exclude' => 1,
                'label' => 'Storage',
                'config' => [
                    'type' => 'input',
                    'eval' => 'int,required'
                ],
            ],
            'access_token' => [
                'exclude' => 1,
                'label' => 'Access Token',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim'
                ],
            ],
            'page_name' => [
                'exclude' => 1,
                'label' => 'Page name',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
            'page_id' => [
                'exclude' => 1,
                'label' => 'Page ID',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
            'page_access_token' => [
                'exclude' => 1,
                'label' => 'Page Access Token',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim'
                ],
            ],
            'callback_url' => [
                'exclude' => 1,
                'label' => 'Callback',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
        ],
        'types' => [
            '0' => ['showitem' => 'name, app_id, app_secret, max_items, storage, access_token'],
        ]
    ];
})();
