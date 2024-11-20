<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\CurrencySubscription;
use Doctrine\Persistence\ManagerRegistry;

class CurrencySubscriptionRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrencySubscription::class);
    }
}