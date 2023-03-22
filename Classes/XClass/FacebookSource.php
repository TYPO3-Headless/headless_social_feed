<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\XClass;

class FacebookSource extends \Pixelant\PxaSocialFeed\Feed\Source\FacebookSource
{
    protected function getEndPointFields(): array
    {
        $fields = parent::getEndPointFields();
        $fields[] = 'comments.summary(true).limit(0)';
        return $fields;
    }
}
