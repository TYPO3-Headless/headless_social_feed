<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\XClass;

class FacebookFeedUpdater extends \Pixelant\PxaSocialFeed\Feed\Update\FacebookFeedUpdater
{
    protected function encodeMessage(string $message): string
    {
        return substr(json_encode($message, JSON_UNESCAPED_UNICODE), 1, -1);
    }
}
