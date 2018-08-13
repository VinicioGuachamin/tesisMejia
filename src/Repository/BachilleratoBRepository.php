<?php

namespace App\Repository;

use App\Entity\BachilleratoB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BachilleratoB|null find($id, $lockMode = null, $lockVersion = null)
 * @method BachilleratoB|null findOneBy(array $criteria, array $orderBy = null)
 * @method BachilleratoB[]    findAll()
 * @method BachilleratoB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BachilleratoBRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BachilleratoB::class);
    }

//    /**
//     * @return BachilleratoB[] Returns an array of BachilleratoB objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BachilleratoB
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
