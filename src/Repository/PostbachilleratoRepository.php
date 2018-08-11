<?php

namespace App\Repository;

use App\Entity\Postbachillerato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Postbachillerato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Postbachillerato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Postbachillerato[]    findAll()
 * @method Postbachillerato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostbachilleratoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Postbachillerato::class);
    }

//    /**
//     * @return Postbachillerato[] Returns an array of Postbachillerato objects
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
    public function findOneBySomeField($value): ?Postbachillerato
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
