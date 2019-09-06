<?php

namespace App\Tests\Unit;

use App\Contracts\MflConnectorInterface;
use App\Services\MflConnector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class MflConnectorTest extends TestCase {

  public function testMakeCall() {
    $connector = new MflConnector(HttpClient::create(), '46324', 'www71.myfantasyleague.com', "2019");
    $data = $connector->makeCall('export', [MflConnectorInterface::TYPE => 'nflByeWeeks']);
    $this->assertIsArray($data->nflByeWeeks->team);
  }
}
