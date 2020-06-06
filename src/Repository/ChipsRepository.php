<?php

namespace App\Repository;

use App\Entity\Chips;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chips|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chips|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chips[]    findAll()
 * @method Chips[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChipsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chips::class);
    }

    // /**
    //  * @return Chips[] Returns an array of Chips objects
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
    public function findOneBySomeField($value): ?Chips
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
