<?php

namespace App\Repository;

use App\Entity\Impress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Impress>
 *
 * @method Impress|null find($id, $lockMode = null, $lockVersion = null)
 * @method Impress|null findOneBy(array $criteria, array $orderBy = null)
 * @method Impress[]    findAll()
 * @method Impress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImpressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Impress::class);
    }

//    /**
//     * @return Impress[] Returns an array of Impress objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Impress
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
