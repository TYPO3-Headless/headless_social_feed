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
        $message = base64_decode($message);
        return str_replace("\\n", "\n", $message);
    }
}
