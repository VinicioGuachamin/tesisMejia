<?php

namespace App\Repository;

use App\Entity\PostbachilleratoB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostbachilleratoB|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostbachilleratoB|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostbachilleratoB[]    findAll()
 * @method PostbachilleratoB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostbachilleratoBRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostbachilleratoB::class);
    }

//    /**
//     * @return PostbachilleratoB[] Returns an array of PostbachilleratoB objects
//     */
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
    public function findOneBySomeField($value): ?PostbachilleratoB
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
