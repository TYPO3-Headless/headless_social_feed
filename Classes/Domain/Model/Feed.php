<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model;

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Feed extends \Pixelant\PxaSocialFeed\Domain\Model\Feed
{
    protected int $comments = 0;

    public function getComments() {
        return $this->comments;
    }

    public function setComments(int $comments) {
        $this->comments = $comments;
    }

    public function getMessage(): string
    {
        $message = parent::getMessage();
        return base64_decode($message);
    }

    protected array $postDateNew = [];

    public function getPostDateNew(): array
    {
        $result = [
            "date" => date_format($this->getPostDate(), "d.m.Y"),
        ];
        ArrayUtility::mergeRecursiveWithOverrule($result, (array)$this->getPostDate()->getTimezone());
        return $result;
    }
}
