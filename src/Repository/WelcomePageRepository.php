<?php

namespace App\Repository;

use App\Entity\WelcomePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WelcomePage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WelcomePage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WelcomePage[]    findAll()
 * @method WelcomePage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WelcomePageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WelcomePage::class);
    }

    // /**
    //  * @return WelcomePage[] Returns an array of WelcomePage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WelcomePage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
