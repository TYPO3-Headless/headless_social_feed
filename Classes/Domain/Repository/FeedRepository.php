<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class FeedRepository extends Repository
{
    public function findByExternalUid(string $externalUid): object
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals(
                'externalUid',
                $externalUid
            )
        );

        return $query->execute()->getFirst();
    }
}