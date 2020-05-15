<?php

namespace App\Repository;

use App\Entity\Ping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ping|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ping|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ping::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('detectTime' => 'DESC'));
    }

    public function findLastDetectByBeaconAddress($beaconAddress)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.deviceAddress = :beaconAddress')
            ->setParameter('beaconAddress', $beaconAddress)
            ->orderBy('p.detectTime', 'DESC');

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findLastDetectSignal()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.detectTime', 'DESC')
            ->getQuery()
            ->execute();

        return $qb;
    }

    // /**
    //  * @return Ping[] Returns an array of Ping objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ping
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
