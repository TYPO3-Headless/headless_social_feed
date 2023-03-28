<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 *
 */
class Configuration extends AbstractEntity
{
    /**
     * @var int
     */
    protected $pid = 0;

    /**
     * @var string
     */
    protected string $name = '';

    /**
     * @var string
     */
    protected string $appId = '';

    /**
     * @var string
     */
    protected string $appSecret = '';

    /**
     * @var int
     */
    protected int $storage = 0;

    /**
     * @var int
     */
    protected int $maxItems = 0;

    /**
     * @var string
     */
    protected string $accessToken = '';

    /**
     * @var string
     */
    protected string $pageId = '';

    /**
     * @var string
     */
    protected string $pageName = '';

    /**
     * @var string
     */
    protected string $pageAccessToken = '';

    /**
     * @return string
     */
    public function getPageAccessToken(): string
    {
        return $this->pageAccessToken;
    }

    /**
     * @param string $pageAccessToken
     */
    public function setPageAccessToken(string $pageAccessToken): void
    {
        $this->pageAccessToken = $pageAccessToken;
    }
    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     */
    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret(string $appSecret): void
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return int
     */
    public function getStorage(): int
    {
        return $this->storage;
    }

    /**
     * @param int $storage
     */
    public function setStorage(int $storage): void
    {
        $this->storage = $storage;
    }

    /**
     * @return int
     */
    public function getMaxItems(): int
    {
        return $this->maxItems;
    }

    /**
     * @param int $maxItems
     */
    public function setMaxItems(int $maxItems): void
    {
        $this->maxItems = $maxItems;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getPageId(): string
    {
        return $this->pageId;
    }

    /**
     * @param string $pageId
     */
    public function setPageId(string $pageId): void
    {
        $this->pageId = $pageId;
    }

    /**
     * @return string
     */
    public function getPageName(): string
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     */
    public function setPageName(string $pageName): void
    {
        $this->pageName = $pageName;
    }
}