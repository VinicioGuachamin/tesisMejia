<?php

namespace App\Repository;

use App\Entity\Asistencias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Asistencias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asistencias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asistencias[]    findAll()
 * @method Asistencias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsistenciasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Asistencias::class);
    }

    // /**
    //  * @return Asistencias[] Returns an array of Asistencias objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Asistencias
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
