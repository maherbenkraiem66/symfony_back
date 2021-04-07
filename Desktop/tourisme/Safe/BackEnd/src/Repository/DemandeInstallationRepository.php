<?php

namespace App\Repository;

use App\Entity\DemandeInstallation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeInstallation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeInstallation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeInstallation[]    findAll()
 * @method DemandeInstallation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeInstallationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeInstallation::class);
    }

    // /**
    //  * @return DemandeInstallation[] Returns an array of DemandeInstallation objects
    //  */
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
    public function findOneBySomeField($value): ?DemandeInstallation
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
