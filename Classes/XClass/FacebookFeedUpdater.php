<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\XClass;

use Pixelant\PxaSocialFeed\Domain\Model\Configuration;
use Pixelant\PxaSocialFeed\Domain\Model\Feed;

class FacebookFeedUpdater extends \Pixelant\PxaSocialFeed\Feed\Update\FacebookFeedUpdater
{
    protected function encodeMessage(string $message): string
    {
        $message = substr(json_encode($message, JSON_UNESCAPED_UNICODE), 1, -1);
        return base64_encode($message);
    }

    protected function updateFeedItem(Feed $feedItem, array $rawData, Configuration $configuration): void
    {
        $updated = strtotime($rawData['updated_time']);
        $feedUpdated = $feedItem->getUpdateDate() ? $feedItem->getUpdateDate()->getTimestamp() : 0;

        if ($feedUpdated < $updated) {
            $this->setFacebookData($feedItem, $rawData);
            $feedItem->setUpdateDate((new \DateTime())->setTimestamp($updated));
        }

        $feedItem->setLikes((int)$rawData['reactions']['summary']['total_count']);
        $feedItem->setComments((int)$rawData['comments']['summary']['total_count']);

        // Call hook
        $this->emitSignal('beforeUpdateFacebookFeed', [$feedItem, $rawData, $configuration]);

        $this->addOrUpdateFeedItem($feedItem);
    }

    protected function setFacebookData(Feed $feed, array $rawData): void
    {
        parent::setFacebookData($feed, $rawData);
        $title = iconv('UTF-8', 'ISO-8859-15//IGNORE', $rawData['message']);
        $title = preg_replace('/\s+/', ' ', $title);
        $feed->setTitle(iconv('ISO-8859-15', 'UTF-8', $title));
    }
}
