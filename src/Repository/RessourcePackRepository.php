<?php

namespace App\Repository;

use App\Entity\RessourcePack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RessourcePack|null find($id, $lockMode = null, $lockVersion = null)
 * @method RessourcePack|null findOneBy(array $criteria, array $orderBy = null)
 * @method RessourcePack[]    findAll()
 * @method RessourcePack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessourcePackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RessourcePack::class);
    }

    // /**
    //  * @return RessourcePack[] Returns an array of RessourcePack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RessourcePack
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
