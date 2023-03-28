<?php
defined('TYPO3') or die('Access denied.');

(function () {
    if(TYPO3_MODE === 'BE') {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'FriendsOfTYPO3.HeadlessSocialFeed',
            'tools',
            'headlesssocialfeed',
            '',
            [
                \FriendsOfTYPO3\HeadlessSocialFeed\Controller\SettingsController::class => 'index, create, import'
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:headless_social_feed/Resources/Public/Icons/feed.svg',
                'labels' => 'LLL:EXT:headless_social_feed/Resources/Private/Language/locallang_be.xlf'
            ]
        );
    }

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'HeadlessSocialFeed',
        'Feed',
        'HeadlessSocialFeed - Feed'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
        'tx_headlesssocialfeed_domain_model_configuration'
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
        'tx_headlesssocialfeed_domain_model_feed'
    );
})();
