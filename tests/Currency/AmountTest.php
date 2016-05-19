<?php
namespace Cassell\Test\Casino\Currency;

use Cassell\Casino\Currency\Amount;

class AmountTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testZero()
    {
        $amt = new Amount(0);
        $this->assertEquals(0,$amt->getAmount());
    }

    /**
     * @test
     */
    public function testRound()
    {
        $amt = new Amount(5.45);
        $this->assertEquals(5,$amt->getAmount());
    }

    /**
     * @test
     */
    public function testIsPositive()
    {
        $this->assertTrue((new Amount(1))->isPositive());
        $this->assertTrue((new Amount(5))->isPositive());
        $this->assertFalse((new Amount(0))->isPositive());
        $this->assertFalse((new Amount(-5))->isPositive());
    }

    /**
     * @test
     */
    public function testAdd()
    {
        $this->assertEquals(5,(new Amount(1))->addAmount(new Amount(4))->getAmount());
        $this->assertEquals(46,(new Amount(31))->addAmount(new Amount(15))->getAmount());
    }

    /**
     * @test
     */
    public function testSub()
    {
        $this->assertEquals(-3,(new Amount(1))->reduceAmount(new Amount(4))->getAmount());
        $this->assertEquals(16,(new Amount(31))->reduceAmount(new Amount(15))->getAmount());
    }

    /**
     * @test
     */
    public function testEquals()
    {
        $this->assertTrue((new Amount(1))->equals(new Amount(1)));
        $this->assertFalse((new Amount(1))->equals(new Amount(2)));
    }

    /**
     * @test
     */
    public function testLessThan()
    {
        $this->assertFalse((new Amount(1))->lessThan(new Amount(1)));
        $this->assertTrue((new Amount(1))->lessThan(new Amount(2)));
    }



}
