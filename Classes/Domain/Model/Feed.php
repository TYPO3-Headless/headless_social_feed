<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model;

class Feed extends \Pixelant\PxaSocialFeed\Domain\Model\Feed
{
    protected int $comments = 0;

    public function getComments() {
        return $this->comments;
    }

    public function setComments(int $comments) {
        $this->comments = $comments;
    }
}
