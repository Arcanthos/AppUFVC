<?php

namespace App\Repository;

use App\Entity\DocumentSubCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DocumentSubCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentSubCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentSubCategory[]    findAll()
 * @method DocumentSubCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentSubCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentSubCategory::class);
    }

    // /**
    //  * @return DocumentSubCategory[] Returns an array of DocumentSubCategory objects
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
    public function findOneBySomeField($value): ?DocumentSubCategory
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
