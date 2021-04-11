<?php

namespace App\Repository;

use App\Entity\Ordersa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ordersa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordersa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordersa[]    findAll()
 * @method Ordersa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordersa::class);
    }

    // /**
    //  * @return Ordersa[] Returns an array of Ordersa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ordersa
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
   
}
