<?php

namespace App\Repository;

use App\Entity\Droits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Droits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Droits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Droits[]    findAll()
 * @method Droits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DroitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Droits::class);
    }

    // /**
    //  * @return Droits[] Returns an array of Droits objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Droits
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
