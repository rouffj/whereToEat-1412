<?php

namespace App\Repository;

use App\Entity\Coworker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coworker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coworker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coworker[]    findAll()
 * @method Coworker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoworkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coworker::class);
    }

    // /**
    //  * @return Coworker[] Returns an array of Coworker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coworker
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
