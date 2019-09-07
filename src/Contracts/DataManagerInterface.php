<?php

namespace App\Contracts;

interface DataManagerInterface {

  public function loadPlayers();

  public function loadWeeks();

  public function loadNflTeams();

  public function loadNflSchedule();
}
