<?php

namespace App\Service;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class IPFinderTest extends TestCase
{
    private $ipFinder;
    private $client;

    public function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
        $this->ipFinder = new IPFinder($this->client);
    }
    
    /**
     * @test
     * @dataProvider ips
     */
    public function shouldReturnIp($ips)
    {
        $response = $this->createMock(Response::class);
        $response->method('getBody')->willReturn($ips);

        $this->client->method('request')->willReturn($response);

        $this->assertEquals($ips, $this->ipFinder->findIp());
    }

    public function ips()
    {
        return [
            ["127.0.0.3"],
            ["127.0.0.4"]
        ];
    }
}