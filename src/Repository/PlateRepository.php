<?php

namespace App\Repository;

use App\Entity\Plate;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Plate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plate[]    findAll()
 * @method Plate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plate::class);
    }

    private function findByCategory(ProductCategory $category)
    {
        $query = $this->createQueryBuilder('p')
        ->where('p.product_category = :product_category')
        ->setParameter('product_category', $category)
        ->getQuery()->getResult();
        return $query;
    }

    // /**
    //  * @return Plate[] Returns an array of Plate objects
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
    public function findOneBySomeField($value): ?Plate
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
