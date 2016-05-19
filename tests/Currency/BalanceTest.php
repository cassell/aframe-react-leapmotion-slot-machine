<?php
namespace Cassell\Test\Casino\Currency;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Balance;

class BalanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testZero()
    {
        $balance = new Balance(0);
        $this->assertEquals(0, $balance->getAmount());
    }

    /**
     * @test
     */
    public function testPositive()
    {
        $balance = new Balance(1);
        $this->assertEquals(1, $balance->getAmount());

        $balance = new Balance(500);
        $this->assertEquals(500, $balance->getAmount());
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testNegative()
    {
        new Balance(-1);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testReduceToNegative()
    {
        $balance = new Balance(5);
        $balance->reduceAmount(new Amount(10));
    }

    /**
     * @test
     */
    public function testReduce()
    {
        $balance = new Balance(5);
        $this->assertEquals(3,$balance->reduceAmount(new Amount(2))->getAmount());
    }

}
