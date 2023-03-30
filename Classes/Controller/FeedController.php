<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Controller;

use DateTime;
use Exception;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository\FeedRepository;
use JsonException;
use TYPO3\CMS\Core\Utility\ArrayUtility;
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
            $feeds = $this->feedRepository->findAll()->getQuery()->setLimit((int)$this->settings['maxShowItems'])->execute();
            $feeds = $feeds->toArray();

            foreach ($feeds as $feed) {
                $date = [
                    "date" => date("d.m.Y", 1679662313),
                ];
                $dateTime = new DateTime();
                $dateTime->setTimestamp($feed->getDateTime());
                ArrayUtility::mergeRecursiveWithOverrule($date, (array)$dateTime->getTimezone());

                if ($feed->getImage()) {
                    $baseUrl = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
                    $image = $baseUrl . 'fileadmin/headlesssocialfeed/' . $feed->getImage();
                } else {
                    $image = '';
                }
                $tempObject = [
                    "uid" => $feed->getUid(),
                    "title" => $feed->getTitle(),
                    "date" => $date,
                    "message" => $feed->getMessage(),
                    "url" => $feed->getUrl(),
                    "image" => $image,
                    "likes" => $feed->getLikes(),
                    "comments" => $feed->getComments()
                ];
                $list[] = $tempObject;
                unset($tempObject);
            }
            return json_encode($list, JSON_THROW_ON_ERROR);
        } catch (JsonException|Exception) {
            return '';
        }
    }
}