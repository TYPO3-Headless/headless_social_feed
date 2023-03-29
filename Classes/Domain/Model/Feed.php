<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Model;

use JsonException;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Feed extends AbstractEntity
{
    /**
     * @var int
     */
    protected $pid = 0;
    /**
     * @var string
     */
    protected string $externalUid = '';
    /**
     * @var int
     */
    protected int $dateTime = 0;
    /**
     * @var string
     */
    protected string $message = '';
    /**
     * @var string
     */
    protected string $image = '';
    /**
     * @var int
     */
    protected int $likes = 0;
    /**
     * @var int
     */
    protected int $comments = 0;

    /**
     * @var string
     */
    protected string $url = '';

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
    public function getExternalUid(): string
    {
        return $this->externalUid;
    }

    /**
     * @param string $externalUid
     */
    public function setExternalUid(string $externalUid): void
    {
        $this->externalUid = $externalUid;
    }

    /**
     * @return int
     */
    public function getDateTime(): int
    {
        return $this->dateTime;
    }

    /**
     * @param int $dateTime
     */
    public function setDateTime(int $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     * @throws JsonException
     */
    public function getMessage(): string
    {
        return json_decode($this->message, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $message
     * @throws JsonException
     */
    public function setMessage(string $message): void
    {
        $this->message = json_encode($message, JSON_THROW_ON_ERROR);
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return int
     */
    public function getComments(): int
    {
        return $this->comments;
    }

    /**
     * @param int $comments
     */
    public function setComments(int $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}