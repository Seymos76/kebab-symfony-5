<?php

namespace App\Repository;

use App\Entity\Salad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Salad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salad[]    findAll()
 * @method Salad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaladRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salad::class);
    }

    // /**
    //  * @return Salad[] Returns an array of Salad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Salad
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
