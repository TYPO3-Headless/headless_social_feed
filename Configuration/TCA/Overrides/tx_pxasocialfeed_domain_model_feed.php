<?php
defined('TYPO3') or die();

$ll = 'LLL:EXT:pxa_social_feed/Resources/Private/Language/locallang_db.xlf:';

$fields = [
    'comments' => [
        'exclude' => 1,
        'label' => 'Comments',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ],
    'message' => [
        'exclude' => 1,
        'label' => $ll . 'tx_pxasocialfeed_domain_model_feeds.message',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim,' . \FriendsOfTYPO3\HeadlessSocialFeed\Evaluation\FeedMessageEvaluation::class
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_pxasocialfeed_domain_model_feed', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_pxasocialfeed_domain_model_feed', 'comments');
