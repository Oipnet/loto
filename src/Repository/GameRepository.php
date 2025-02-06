<?php

namespace App\Repository;

use App\Entity\Game;
use App\Enum\GameState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function save(Game $game, $flush = false): void
    {
        $this->getEntityManager()->persist($game);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findGameFromDate(\DateTimeImmutable $from)
    {
        return $this->createQueryBuilder('g')
            ->where('g.date > :now')
            ->setParameter('now', $from)
            ->getQuery()
            ->getResult();
    }

    public function findPending(): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.state = :state')
            ->setParameter('state', GameState::IN_PROGRESS)
            ->orderBy('g.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
