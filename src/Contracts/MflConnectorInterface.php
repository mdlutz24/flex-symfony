<?php

namespace App\Contracts;

interface MflConnectorInterface {

  const AUTH_COOKIE = 'MFL_USER_ID';

  const DETAILS = 'DETAILS';
  const JSON = 'JSON';
  const LEAGUE_ID = 'L';
  const PLAYERS = 'PLAYERS';
  const SINCE = 'SINCE';
  const TYPE = 'TYPE';
  const WEEK = 'W';

  /**
   * Makes a generic call.
   *
   * @param string $command
   * @param array $args
   *
   * @return object
   */
  public function makeCall($command = 'export', $args = []);

  /**
   * Makes an export call.
   *
   * @param string $type
   * @param array $args
   *
   * @return object
   */
  public function export($type, array $args = []);

  /**
   * Makes an import call.
   *
   * @param string $type
   * @param array $args
   *
   * @return object
   */
  public function import($type, array $args = []);

  /**
   * Gets the player list.
   *
   * @param int $since
   * @param array $players
   * @param bool $details
   *
   * @return object
   */
  public function getPlayers($since = 0, array $players = [], bool $details = FALSE);

  /**
   * Gets the NFL schedule.
   *
   * @param string $week
   *
   * @return object
   */
  public function getNflSchedule($week = 'ALL');
}