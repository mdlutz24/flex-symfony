<?php

namespace App\Repository;

use App\Entity\NflGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NflGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method NflGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method NflGame[]    findAll()
 * @method NflGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NflGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NflGame::class);
    }

    // /**
    //  * @return NflGame[] Returns an array of NflGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NflGame
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
