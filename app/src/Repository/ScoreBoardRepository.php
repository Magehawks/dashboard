<?php

namespace App\Repository;

use App\Entity\ScoreBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScoreBoard>
 *
 * @method ScoreBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScoreBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScoreBoard[]    findAll()
 * @method ScoreBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScoreBoard::class);
    }


    public function findByGameOrdered($gameId = null, $category = null)
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.points', 'DESC')
            ->addOrderBy('s.time', 'ASC');

        if ($gameId !== null) {
            $qb->andWhere('s.game = :gameId')
                ->setParameter('gameId', $gameId);
        }

        if ($category !== null) {
            $qb->andWhere('s.category = :category')
                ->setParameter('category', $category);
        }

        return $qb->getQuery()->getResult();
    }
}
