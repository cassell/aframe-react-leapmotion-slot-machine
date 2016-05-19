<?php
namespace Cassell\Test\Casino\Currency;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;

class WagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testInstanceOfAmount()
    {
        $this->assertInstanceOf(Amount::class,new Wager(1));
    }

    /**
     * @test
     */
    public function testPositiveAmount()
    {
        $this->assertEquals(1,(new Wager(1))->getAmount());
        $this->assertEquals(15,(new Wager(15))->getAmount());
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testZero()
    {
        new Wager(0);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testNegative()
    {
        new Wager(-5);
    }

}