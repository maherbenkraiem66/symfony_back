<?php

namespace App\Repository;

use App\Entity\PTS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PTS|null find($id, $lockMode = null, $lockVersion = null)
 * @method PTS|null findOneBy(array $criteria, array $orderBy = null)
 * @method PTS[]    findAll()
 * @method PTS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PTSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PTS::class);
    }

    // /**
    //  * @return PTS[] Returns an array of PTS objects
    //  */
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
    public function findOneBySomeField($value): ?PTS
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
