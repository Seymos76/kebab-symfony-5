<?php

namespace App\Repository;

use App\Entity\HomeMade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomeMade|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeMade|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeMade[]    findAll()
 * @method HomeMade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeMadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeMade::class);
    }

    // /**
    //  * @return HomeMade[] Returns an array of HomeMade objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeMade
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
