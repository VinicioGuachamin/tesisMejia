<?php

namespace App\Repository;

use App\Entity\Bachillerato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bachillerato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bachillerato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bachillerato[]    findAll()
 * @method Bachillerato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BachilleratoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bachillerato::class);
    }

//    /**
//     * @return Bachillerato[] Returns an array of Bachillerato objects
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
    public function findOneBySomeField($value): ?Bachillerato
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
