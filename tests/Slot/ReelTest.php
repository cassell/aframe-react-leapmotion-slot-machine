<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Symbol;

class ReelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testStopsCount()
    {
        $reel = new Reel([new Symbol("A"), new Symbol("B"), new Symbol("C")]);
        $this->assertEquals(3,$reel->getNumberOfStops());
    }

    /**
     * @test
     */
    public function testSpin()
    {
        $reel = new Reel([new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E"),
            new Symbol("F")]);
        $this->assertContains($reel->spin()->getSymbol()->getName(),["A","B","C","D","E","F"]);
        $this->assertContains($reel->spin()->getSymbol()->getName(),["A","B","C","D","E","F"]);
        $this->assertContains($reel->spin()->getSymbol()->getName(),["A","B","C","D","E","F"]);
        $this->assertContains($reel->spin()->getSymbol()->getName(),["A","B","C","D","E","F"]);
    }

    /**
     * @test
     */
    public function testSpinIsRandomish()
    {
        $reel = new Reel([new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")]);

        $results = [];

        for ($i = 0; $i < 100; $i++) {
            $results[$reel->spin()->getSymbol()->getName()] += 1;
        }

        $this->assertCount(5,$results);
    }

    /**
     * @test
     */
    public function testRepeatedStops()
    {
        $reel = new Reel([new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("A"),
            new Symbol("B")]);

        $results = [];

        for ($i = 0; $i < 100; $i++) {
            $results[$reel->spin()->getSymbol()->getName()] += 1;
        }

        $this->assertCount(3,$results);
    }

}
