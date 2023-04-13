<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Controller;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use FriendsOfTYPO3\HeadlessSocialFeed\Authorization\FacebookAuth;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Configuration;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model\Feed;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository\ConfigurationRepository;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository\FeedRepository;
use JsonException;
use RuntimeException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class SettingsController extends ActionController
{
    protected $configurationRepository;
    protected $persistenceManager;
    protected $feedRepository;

    public function __construct()
    {
        $this->configurationRepository = GeneralUtility::makeInstance(ConfigurationRepository::class);
        $this->persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $this->feedRepository = GeneralUtility::makeInstance(FeedRepository::class);
    }

    public function indexAction(): void
    {
        $result = [];
        $configuration = $this->configurationRepository->getConfiguration();
        if ($configuration) {
            $result = [
                'uid' => $configuration->getUid(),
                'name' => $configuration->getName(),
                'appId' => $configuration->getAppId(),
                'appSecret' => $configuration->getAppSecret(),
                'storage' => $configuration->getStorage(),
                'maxItems' => $configuration->getMaxItems(),
                'pageId' => $configuration->getPageId(),
                'pageName' => $configuration->getPageName(),
                'callbackUrl' => $configuration->getCallbackUrl(),
            ];
        }
        $this->view->assignMultiple($result);
    }

    public function createAction(): void
    {
        try {
            $result = [];
            $queryParams = GeneralUtility::_GP('tx_headlesssocialfeed_tools_headlesssocialfeedheadlesssocialfeed');
            if ($queryParams) {
                if ($queryParams['uid']) {
                    $configuration = $this->configurationRepository->findByUid($queryParams['uid']);
                    if ($configuration && $configuration->getAccessToken()) {
                        if ($configuration->getPageId() && $configuration->getPageAccessToken()) {
                            $result['message'] = 'Configuration fine';
                        } else {
                            $pageData = $this->getPageData($configuration->getAppId(), $configuration->getAppSecret(), $configuration->getAccessToken(), $queryParams['pageName']);
                            if ($pageData) {
                                $configuration->setPageId($pageData['pageId']);
                                $configuration->setPageAccessToken($pageData['pageAccessToken']);
                                $this->configurationRepository->update($configuration);
                                $this->persistenceManager->persistAll();
                                $result['message'] = "Configuration fine";
                            } else {
                                $result['message'] = 'An error occurred while getting page id';
                            }
                        }
                    } else if ($configuration->getAppId() && $configuration->getAppSecret()) {
                        $result['url'] = $this->generateLoginUrl($configuration->getAppId(), $configuration->getAppSecret(), $configuration->getCallbackUrl());
                    } else {
                        $result['message'] = "No appId and appSecret provided";
                    }
                } else {
                    $configuration = GeneralUtility::makeInstance(Configuration::class);
                    $configuration->setName($queryParams['name']);
                    $configuration->setAppId($queryParams['appId']);
                    $configuration->setAppSecret($queryParams['appSecret']);
                    $configuration->setStorage($queryParams['storage']);
                    $configuration->setMaxItems($queryParams['maxItems']);
                    $configuration->setPageName($queryParams['pageName']);
                    $configuration->setCallbackUrl($queryParams['callbackUrl']);
                    $this->configurationRepository->add($configuration);
                    $this->persistenceManager->persistAll();
                    $result['url'] = $this->generateLoginUrl($configuration->getAppId(), $configuration->getAppSecret(), $configuration->getCallbackUrl());
                }
            } else {
                $result['message'] = 'Wrong query parameters';
            }
        } catch (IllegalObjectTypeException|UnknownObjectException $e) {
            $result['message'] = $e->getMessage();
        }
        $this->view->assignMultiple($result);
    }

    public function importAction(): void
    {
        $result = $this->importFeeds();
        $this->view->assignMultiple($result);
    }

    public function importFeeds(): array
    {
        $result = [];
        try {
            $configuration = $this->configurationRepository->getConfiguration();
            if (!$configuration) {
                throw new RuntimeException("No configuration found");
            }
            $fb = $this->getFacebookObject($configuration->getAppId(), $configuration->getAppSecret());
            $fb->setDefaultAccessToken($configuration->getPageAccessToken());

            $response = $fb->get("/{$configuration->getPageId()}/feed?fields=id,created_time,message,full_picture,comments.summary(true).limit(0),reactions.summary(true).limit(0),permalink_url&limit={$configuration->getMaxItems()}");
            $posts = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);

            foreach ($posts->data as $post) {
                $create = false;
                $feed = $this->feedRepository->findByExternalUid($post->id);
                if (!$feed) {
                    $create = true;
                    $feed = GeneralUtility::makeInstance(Feed::class);
                }
                $feed->setExternalUid($post->id);
                $feed->setComments(($post->comments->summary->total_count) ?: 0);
                if ($post->full_picture) {
                    $image = $this->saveImage($post->full_picture);
                    if ($image) {
                        $feed->setImage($image);
                    } else {
                        $feed->setImage($post->full_picture);
                    }
                }
                $feed->setLikes(($post->reactions->summary->total_count) ?: 0);
                $feed->setMessage(($post->message) ?: '');
                if ($post->created_time) {
                    $feed->setDateTime(strtotime($post->created_time));
                } else {
                    $feed->setDateTime(0);
                }
                $feed->setPid($configuration->getStorage());
                $feed->setUrl(($post->permalink_url) ?: '');
                $feed->setTitle("Facebook " . $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename']);
                if ($create) {
                    $this->feedRepository->add($feed);
                } else {
                    $this->feedRepository->update($feed);
                }
            }
            $this->persistenceManager->persistAll();
        } catch (RuntimeException|FacebookSDKException|IllegalObjectTypeException|UnknownObjectException|JsonException $e) {
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    protected function generateLoginUrl(string $appId, string $appSecret, string $callbackUrl): string
    {
        session_start();
        $url = $callbackUrl;
        $url .= "?type=100&no_cache=1";
        return (new FacebookAuth($appId, $appSecret, $url))->getLoginUrl(['pages_show_list','pages_read_engagement','pages_manage_metadata','pages_read_user_content','pages_manage_posts','email']);
    }

    protected function getPageData(string $appId, string $appSecret, string $accessToken, string $pageName): bool|array
    {
        try {
            $fb = $this->getFacebookObject($appId, $appSecret);

            $fb->setDefaultAccessToken($accessToken);
            $response = $fb->get('/me/accounts');
            $pages = $response->getGraphEdge();

            $pageId = '';
            $pageAccessToken = '';
            foreach ($pages as $page) {
                $page = $page->asArray();
                if ($page['name'] === $pageName) {
                    $pageId = $page['id'];
                    $pageAccessToken = $page['access_token'];
                    break;
                }
            }

            return [
                "pageId" => $pageId,
                "pageAccessToken" => $pageAccessToken
            ];
        } catch (FacebookSDKException) {
            return false;
        }
    }

    /**
     * @throws FacebookSDKException
     */
    protected function getFacebookObject(string $appId, string $appSecret): Facebook
    {
        return new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v12.0'
        ]);
    }

    protected function saveImage(string $imageUrl): bool|string
    {
        $targetPath = '../fileadmin/headlesssocialfeed/';
        if (!is_dir($targetPath) && !mkdir($targetPath, 0777, true) && !is_dir($targetPath)) {
            return false;
        }

        $fullUrl = $imageUrl;
        $imageUrl = strtok($imageUrl, "?");
        $filename = basename($imageUrl);
        $fileContent = file_get_contents($fullUrl);
        $filepath = $targetPath . $filename;

        if (file_exists($filepath)) {
            return $filename;
        }

        if ($fileContent !== false) {
            file_put_contents($filepath, $fileContent);
            return $filename;
        }
        return false;
    }
}