<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Controller;

use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository\FeedRepository;
use JsonException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class FeedController extends ActionController
{
    protected $feedRepository;

    public function __construct()
    {
        $this->feedRepository = GeneralUtility::makeInstance(FeedRepository::class);
    }

    public function listAction(): bool|string
    {
        try {
            $list = [];
            $feeds = $this->feedRepository->findAll();
            $feeds = $feeds->toArray();
            foreach ($feeds as $feed) {
                $tempObject = [
                    "uid" => $feed->getUid(),
                    "title" => $feed->getMessage(),
                    "date" => $feed->getDateTime(),
                    "message" => $feed->getMessage(),
                    "url" => '',
                    "image" => $feed->getImage(),
                    "likes" => $feed->getLikes(),
                    "comments" => $feed->getComments()
                ];
                $list[] = $tempObject;
                unset($tempObject);
            }
            return json_encode($list, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return '';
        }
    }
}