<?php

declare(strict_types=1);

return [
    \FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Feed::class => [
        'tableName' => 'tx_pxasocialfeed_domain_model_feed',
        'recordType' => \FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Feed::class,
        'properties' => [
            'comments' => [
                'fieldName' => 'comments',
            ],
        ],
    ],
];
