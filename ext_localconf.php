<?php
defined('TYPO3') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError'] = 0;

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HeadlessSocialFeed',
    'Callback',
    [
        \FriendsOfTYPO3\HeadlessSocialFeed\Controller\CallbackController::class => 'retrieve',
    ],
    [
        \FriendsOfTYPO3\HeadlessSocialFeed\Controller\CallbackController::class => 'retrieve',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'HeadlessSocialFeed',
    'Settings',
    [
        \FriendsOfTYPO3\HeadlessSocialFeed\Controller\SettingsController::class => 'create,import',
    ],
    [
        \FriendsOfTYPO3\HeadlessSocialFeed\Controller\SettingsController::class => 'create,import',
    ]
);

call_user_func(
    static function($extensionKey) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'HeadlessSocialFeed',
            'Feed',
            [
                \FriendsOfTYPO3\HeadlessSocialFeed\Controller\FeedController::class => 'list',
            ],
            [
                \FriendsOfTYPO3\HeadlessSocialFeed\Controller\FeedController::class => 'list',
            ]
        );
    },
    'headless_social_feed'
);

