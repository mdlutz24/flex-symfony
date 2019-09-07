<?php

namespace App\Services;

use App\Contracts\MflConnectorInterface;
use Nyholm\Psr7\Uri;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MflConnector implements MflConnectorInterface {

  /**
   * @var \Symfony\Contracts\HttpClient\HttpClientInterface
   */
  protected $client;

  /**
   * @var string
   */
  protected $host;

  /**
   * @var string
   */
  protected $scheme;

  /**
   * @var string
   */
  protected $year;

  /**
   * @var string
   */
  protected $leagueId;

  /**
   * @var string
   */
  protected $authCookie;

  /**
   * Constructs a Connector object.
   *
   * @param HttpClientInterface $client
   * @param string $league_id
   * @param string $host
   * @param string $year
   * @param string $scheme
   */
  public function __construct(HttpClientInterface $client, $league_id, $host, $year = '', $scheme = 'https') {

    if (!$year) {
      $year = date('Y', time() - (60*60*24*180));
    }

    $this->client = $client;
    $this->leagueId = $league_id;
    $this->host = $host;
    $this->year = $year;
    $this->scheme = $scheme;
  }

  /**
   * Gets the value of $Host.
   *
   * @return string
   */
  public function getHost(): string {
    return $this->host;
  }

  /**
   * Sets the value of $host.
   *
   * @param string $host
   *
   * @return MflConnector
   */
  public function setHost(string $host): MflConnector {
    $this->host = $host;
    return $this;
  }

  /**
   * Gets the value of $Scheme.
   *
   * @return string
   */
  public function getScheme(): string {
    return $this->scheme;
  }

  /**
   * Sets the value of $scheme.
   *
   * @param string $scheme
   *
   * @return MflConnector
   */
  public function setScheme(string $scheme): MflConnector {
    $this->scheme = $scheme;
    return $this;
  }

  /**
   * Gets the value of $Year.
   *
   * @return string
   */
  public function getYear(): string {
    return $this->year;
  }

  /**
   * Sets the value of $year.
   *
   * @param string $year
   *
   * @return MflConnector
   */
  public function setYear(string $year): MflConnector {
    $this->year = $year;
    return $this;
  }

  /**
   * Gets the value of $LeagueId.
   *
   * @return string
   */
  public function getLeagueId(): string {
    return $this->leagueId;
  }

  /**
   * Sets the value of $leagueId.
   *
   * @param string $leagueId
   *
   * @return MflConnector
   */
  public function setLeagueId(string $leagueId): MflConnector {
    $this->leagueId = $leagueId;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function makeCall($command = 'export', $args = []) {
    $uri = static::getUri($this->scheme, $this->host, $this->year, $command);
    $options = ['query' => $args + [static::JSON => '1']];
    if (!empty($this->authCookie)){
      $options['headers'] = ['cookie' => static::AUTH_COOKIE . '=' . $this->authCookie];
    }

    $response = $this->client->request('GET', $uri, $options);
    if ($response->getStatusCode() === 200) {
      return \json_decode($response->getContent());
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function export($type, array $args = []) {
    return $this->makeCall('export', $args + [static::TYPE => $type])->{$type};
  }

  /**
   * {@inheritdoc}
   */
  public function import($type, array $args = []) {
    return $this->makeCall('import', $args + [static::TYPE => $type]);
  }

  /**
   * {@inheritdoc}
   */
  public function getPlayers($since = 0, array $players = [], bool $details = FALSE) {
    $args = [];
    if ($since) {
      $args[static::SINCE] = $since;
    }
    if ($players) {
      $args[static::PLAYERS] = explode(',', $players);
    }
    if ($details) {
      $args[static::DETAILS] = '1';
    }
    return $this->export('players', $args);
  }

  /**
   * {@inheritdoc}
   */
  public function getNflSchedule($week = 'ALL') {
    $args[static::WEEK] = $week;
    return $this->export('nflSchedule', $args);
  }

  /**
   * Gets a base Uri from the scheme, host, year and command.
   *
   * @param string $scheme
   * @param string $host
   * @param string $year
   * @param string $command
   *
   * @return \Psr\Http\Message\UriInterface
   */
  public static function getUri($scheme, $host, $year, $command) {
    return (new Uri())
      ->withScheme($scheme)
      ->withHost($host)
      ->withPath(sprintf("%s/%s", $year, $command));
  }

}
