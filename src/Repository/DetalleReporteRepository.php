<?php

namespace App\Repository;

use App\Entity\DetalleReporte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DetalleReporte|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleReporte|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleReporte[]    findAll()
 * @method DetalleReporte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleReporteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DetalleReporte::class);
    }

//    /**
//     * @return DetalleReporte[] Returns an array of DetalleReporte objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetalleReporte
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
