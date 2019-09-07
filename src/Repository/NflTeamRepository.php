<?php

namespace App\Repository;

use App\Entity\NflTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NflTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method NflTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method NflTeam[]    findAll()
 * @method NflTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NflTeamRepository extends ServiceEntityRepository
{
  protected $teamList;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NflTeam::class);
    }

  /**
   * @return NflTeam[]
   */
    public function getAllById() {
      if (empty($this->teamList)) {
        $this->teamList = [];
        $teams = $this->findAll();
        foreach($teams as $team) {
          $this->teamList[$team->getShortName()] = $team;
        }
      }
      return $this->teamList;
    }
    // /**
    //  * @return NflTeam[] Returns an array of NflTeam objects
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
    public function findOneBySomeField($value): ?NflTeam
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
