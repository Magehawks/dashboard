<?php

namespace App\Repository;

use App\Entity\DataPrivacy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DataPrivacy>
 *
 * @method DataPrivacy|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataPrivacy|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataPrivacy[]    findAll()
 * @method DataPrivacy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataPrivacyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataPrivacy::class);
    }

//    /**
//     * @return DataPrivacy[] Returns an array of DataPrivacy objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DataPrivacy
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
