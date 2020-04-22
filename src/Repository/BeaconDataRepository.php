<?php

namespace App\Repository;

use App\Entity\BeaconData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BeaconData|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeaconData|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeaconData[]    findAll()
 * @method BeaconData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeaconDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeaconData::class);
    }

    // /**
    //  * @return BeaconData[] Returns an array of BeaconData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BeaconData
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
