<?php
defined('TYPO3_MODE') || die();

call_user_func(function () {
    /**
     * Default TypoScript for Headless Social Feed
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'headless_social_feed',
        'Configuration/TypoScript',
        'Headless Social Feed'
    );
});
