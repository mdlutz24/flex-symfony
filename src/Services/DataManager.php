<?php

namespace App\Services;

use App\Contracts\DataManagerInterface;
use App\Contracts\MflConnectorInterface;
use App\Entity\NflTeam;
use App\Entity\Week;
use App\Repository\NflTeamRepository;
use App\Repository\PlayerRepository;
use App\Repository\WeekRepository;
use Doctrine\ORM\EntityManagerInterface;

class DataManager implements DataManagerInterface {

  /**
   * @var MflConnectorInterface
   */
  protected $mfl;

  /**
   * @var EntityManagerInterface
   */
  protected $entityManager;

  public function __construct(MflConnectorInterface $connector, EntityManagerInterface $entity_manager) {
    $this->mfl = $connector;
    $this->entityManager = $entity_manager;
  }

  public function loadPlayers() {
    /** @var PlayerRepository $player_repository */
    $player_repository = $this->entityManager->getRepository(PlayerRepository::class);
    $players = $this->mfl->getPlayers();
    foreach($players as $player) {
      if ($player_repository->findOneBy(['mflId' =>'' ])) {


      }
    }
  }

  public function loadWeeks() {
    $week_repository = $this->entityManager->getRepository(Week::class);
    $start = new \DateTime("2019-09-03 06:00:00");
    $one_week = new \DateInterval("P1W");
    for ($i = 1; $i < 17; $i++) {
      if (!$week = $week_repository->findOneBy(['value' => $i])) {
        $week = new Week();
      }
      $week->setName("Week $i")
        ->setValue($i)
        ->setStartDate($start);
      $this->entityManager->persist($week);
      $this->entityManager->flush();
      $start->add($one_week);
    }

  }
  public function loadNflTeams() {
    $team_repository = $this->entityManager->getRepository(NflTeam::class);
    $week_repository = $this->entityManager->getRepository(Week::class);
    $teams = $this->mfl->export('nflByeWeeks');
    foreach ($teams->team as $team) {
      if (!$team_entity = $team_repository->findBy(['shortName' => $team->id])) {
        $team_entity = new NflTeam();
        $team_entity->setShortName($team->id)
          ->setName($team->id);
      }
      $team_entity->setByeWeek($week_repository->findOneBy(['value' => $team->bye_week]));
      $this->entityManager->persist($team_entity);
    }
    $this->entityManager->flush();
  }
}
