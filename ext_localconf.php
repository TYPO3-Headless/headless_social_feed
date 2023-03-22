<?php
defined('TYPO3') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\Pixelant\PxaSocialFeed\Feed\Update\FacebookFeedUpdater::class] = [
    'className' => \FriendsOfTYPO3\HeadlessSocialFeed\XClass\FacebookFeedUpdater::class
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\Pixelant\PxaSocialFeed\Feed\Source\FacebookSource::class] = [
    'className' => \FriendsOfTYPO3\HeadlessSocialFeed\XClass\FacebookSource::class
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\Pixelant\PxaSocialFeed\Domain\Model\Feed::class] = [
    'className' => \FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Feed::class
];

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
    ->registerImplementation(
        \Pixelant\PxaSocialFeed\Domain\Model\Feed::class,
        \FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Feed::class
    );
