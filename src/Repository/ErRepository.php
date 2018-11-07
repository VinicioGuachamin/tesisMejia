<?php

namespace App\Repository;

use App\Entity\Er;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Er|null find($id, $lockMode = null, $lockVersion = null)
 * @method Er|null findOneBy(array $criteria, array $orderBy = null)
 * @method Er[]    findAll()
 * @method Er[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ErRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Er::class);
    }

//    /**
//     * @return Er[] Returns an array of Er objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Er
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
