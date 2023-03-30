<?php
defined('TYPO3_MODE') or die();

return (function() {
    return [
        'ctrl' => [
            'title' => 'Feed',
            'label' => 'message',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'default_sortby' => 'crdate DESC',
            'delete' => 'deleted',
            'searchFields' => 'message',
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
            'external_uid' => [
                'exclude' => 1,
                'label' => 'External UID',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'date_time' => [
                'exclude' => 1,
                'label' => 'Feed datetime',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'message' => [
                'exclude' => 1,
                'label' => 'Message',
                'config' => [
                    'type' => 'input',
                    'size' => 30,
                    'eval' => 'trim,required'
                ],
            ],
            'image' => [
                'exclude' => 1,
                'label' => 'Image',
                'config' => [
                    'type' => 'input',
                    'eval' => 'int'
                ],
            ],
            'likes' => [
                'exclude' => 1,
                'label' => 'Likes',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
            'comments' => [
                'exclude' => 1,
                'label' => 'Comments',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
            'url' => [
                'exclude' => 1,
                'label' => 'Url',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
            'title' => [
                'exclude' => 1,
                'label' => 'Title',
                'config' => [
                    'type' => 'input',
                    'eval' => 'trim,required'
                ],
            ],
        ],
        'types' => [
            '0' => ['showitem' => 'message'],
        ]
    ];
})();
