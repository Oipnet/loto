<?php

namespace App\Repository;

use App\Entity\PrizeNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrizeNumber>
 */
class PrizeNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrizeNumber::class);
    }

    public function save(PrizeNumber $prizeNumber, bool $flush = true): void
    {
        $this->getEntityManager()->persist($prizeNumber);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
