<?php
defined('TYPO3') or die();

$fields = [
    'comments' => [
        'exclude' => 1,
        'label' => 'Comments',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'eval' => 'int'
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_pxasocialfeed_domain_model_feed', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_pxasocialfeed_domain_model_feed', 'comments');
