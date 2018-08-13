<?php

namespace App\Repository;

use App\Entity\SuperiorB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperiorB|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperiorB|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperiorB[]    findAll()
 * @method SuperiorB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperiorBRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperiorB::class);
    }

//    /**
//     * @return SuperiorB[] Returns an array of SuperiorB objects
//     */
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
    public function findOneBySomeField($value): ?SuperiorB
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
