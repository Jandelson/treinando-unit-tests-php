<?php

namespace App\Service;

use App\Entity\Location;
use App\Exception\ErrorOnFindingLocation;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class LocationFinderTest extends TestCase
{

    private $location;
    private $client;
    private $response;

    public function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
        $this->response = $this->createMock(Response::class);
        $this->location =  new LocationFinder($this->client);
    }

    /**
     * @test
     */
    public function shouldReturnLocation()
    {
        $this->response->method('getStatusCode')->willReturn(200);
        $this->response->method('getBody')->willReturn(json_encode([
            'continent_code' => 'EU',
            'country_name' => 'PT',
            'city' => 'Lisbon',
            'timezone' => 'Europe/Lisbon',
        ]));
        
        $this->client->method('request')->willReturn($this->response);

        $this->assertInstanceOf(Location::class, $this->location->findLocation("127.0.0.3"));
    }

     /**
     * @test
     */
    public function shouldReturnException()
    {    
        $this->expectException(ErrorOnFindingLocation::class);

        $this->response->method('getStatusCode')->willReturn(500);
        $this->client->method('request')->willReturn($this->response);

        $this->location->findLocation("127.0.0.1");
    }
}