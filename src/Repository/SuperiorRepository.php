<?php

namespace App\Repository;

use App\Entity\Superior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Superior|null find($id, $lockMode = null, $lockVersion = null)
 * @method Superior|null findOneBy(array $criteria, array $orderBy = null)
 * @method Superior[]    findAll()
 * @method Superior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperiorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Superior::class);
    }

//    /**
//     * @return Superior[] Returns an array of Superior objects
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
    public function findOneBySomeField($value): ?Superior
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
