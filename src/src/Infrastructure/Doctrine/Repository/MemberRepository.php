<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\Member;
use Doctrine\Persistence\ManagerRegistry;

class MemberRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    /**
     * @return array
     */
    public function getActiveSubscriptions(): array
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select('u', 'cs')
            ->leftJoin('u.currencySubscription', 'cs')
            ->where('cs.isActive = :isActive')
            ->setParameter('isActive', true)
            ->getQuery()
            ->getResult();
    }
}