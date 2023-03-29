<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ConfigurationRepository extends Repository
{
    protected $defaultOrderings = [
        'crdate' => QueryInterface::ORDER_DESCENDING
    ];

    public function getConfiguration(): ?object
    {
        $query = $this->createQuery();
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
}