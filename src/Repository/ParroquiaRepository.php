<?php

namespace App\Repository;

use App\Entity\Parroquia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parroquia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parroquia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parroquia[]    findAll()
 * @method Parroquia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParroquiaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parroquia::class);
    }

//    /**
//     * @return Parroquia[] Returns an array of Parroquia objects
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
    public function findOneBySomeField($value): ?Parroquia
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
