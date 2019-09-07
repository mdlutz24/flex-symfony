<?php

namespace App\Services;

use App\Contracts\DataManagerInterface;
use App\Contracts\MflConnectorInterface;
use App\Entity\NflGame;
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
      if (!$team_entity = $team_repository->findOneBy(['shortName' => $team->id])) {
        $team_entity = new NflTeam();
        $team_entity->setShortName($team->id)
          ->setName($team->id);
      }
      $team_entity->setByeWeek($week_repository->findOneBy(['value' => $team->bye_week]));
      $this->entityManager->persist($team_entity);
    }
    $this->entityManager->flush();
  }

  public function loadNflSchedule() {
    /** @var Week[] $weeks */
    $weeks = $this->entityManager->getRepository(Week::class)->findAll();

    /** @var NflTeamRepository $team_repository */
    $team_repository = $this->entityManager->getRepository(NflTeam::class);
    $teams = $team_repository->getAllById();

    /** @var \App\Repository\NflGameRepository $game_repository */
    $game_repository = $this->entityManager->getRepository(NflGame::class);

    foreach ($weeks as $week) {
      $schedule = $this->mfl->getNflSchedule($week->getValue());
      foreach ($schedule->matchup as $matchup) {
        $hometeam = $matchup->team[0]->isHome ? $matchup->team[0]->id : $matchup->team[1]->id;
        $awayteam = $matchup->team[1]->isHome ? $matchup->team[0]->id : $matchup->team[1]->id;
        $criteria = [
          'week' => $week->getValue(),
          'homeTeam' => $teams[$hometeam],
          'awayTeam' => $teams[$awayteam],
        ];
        /* @var \App\Entity\NflGame $game */
        if (!$game = $game_repository->findOneBy($criteria)) {
          $game = new NflGame();
        }
        $game->setKickoff(\DateTime::createFromFormat('U', $matchup->kickoff, new \DateTimeZone("America/Detroit")))
          ->setWeek($week)
          ->setSecondsRemaining($matchup->gameSecondsRemaining)
          ->setAwayTeam($teams[$awayteam])
          ->setHomeTeam($teams[$hometeam]);
        $this->entityManager->persist($game);
      }
    }
    $this->entityManager->flush();
  }

}
