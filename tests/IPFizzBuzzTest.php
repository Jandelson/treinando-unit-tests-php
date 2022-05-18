<?php

namespace App\Service;

use App\Exception\InvalidIP4Format;
use PHPUnit\Framework\TestCase;

class IPFizzBuzzTest extends TestCase
{
    private $ipFizzBuzz;

    public function setUp(): void
    {
        $this->ipFizzBuzz = new IPFizzBuzz();
    }

    /**
     * @test
     */
    public function shouldReturnFizz()
    {
        $this->assertEquals("Fizz", $this->ipFizzBuzz->getFizzBuzzByIP("127.0.0.3"));
    }
    
    /**
     * @test
     */
    public function shouldReturnBuzz()
    {
        $this->assertEquals("Buzz", $this->ipFizzBuzz->getFizzBuzzByIP("127.0.0.5"));
    }

    /**
     * @test
     * @dataProvider getFizzBuzz
     */
    public function shouldReturnFizzBuzz($lastNumber)
    {
        $this->assertEquals("FizzBuzz", $this->ipFizzBuzz->getFizzBuzzByIP("127.0.0." . $lastNumber));
    }

    /**
     * @test
      * @dataProvider getFizzBuzz
     */
    public function shouldNotReturnFizzBuzz()
    {
        $this->assertEquals("1", $this->ipFizzBuzz->getFizzBuzzByIP("127.0.0.1"));
    }

     /**
     * @test
     * @dataProvider getNoIP
     */
    public function shouldReturnException($noIp)
    {
        $this->expectException(InvalidIP4Format::class);

        $this->ipFizzBuzz->getFizzBuzzByIP($noIp);
    }

    public function getFizzBuzz()
    {
        return [
            ["15"],
            ["30"],
            ["45"],
        ];
    }

    public function getNoIP()
    {
        return [
            ["jandelson"],
            ["1277.88.8"]
        ];
    }
}