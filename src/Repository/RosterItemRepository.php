<?php

namespace App\Repository;

use App\Entity\RosterItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RosterItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method RosterItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method RosterItem[]    findAll()
 * @method RosterItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RosterItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RosterItem::class);
    }

    // /**
    //  * @return RosterItem[] Returns an array of RosterItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RosterItem
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
