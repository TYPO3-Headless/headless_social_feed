<?php
defined('TYPO3') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\Pixelant\PxaSocialFeed\Feed\Update\FacebookFeedUpdater::class] = [
    'className' => \FriendsOfTYPO3\HeadlessSocialFeed\XClass\FacebookFeedUpdater::class
];
