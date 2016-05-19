<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\PayLine;
use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Reels;
use Cassell\Casino\Slot\ReelSpinResult;
use Cassell\Casino\Slot\Symbol;

class ReelsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Exception
     */
    public function testZeroReels()
    {
        new Reels([]);
    }

    /**
     * @test
     */
    public function testOneReel()
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")];

        $reel1 = new Reel($stops);

        $reels = new Reels([$reel1]);

        $payline = $reels->spin();

        $this->assertCount(1,$payline);

        /** @var ReelSpinResult $result */
        foreach($payline as $result) {
            $this->assertContains($result->getSymbol(),$stops);
        }

    }

    /**
     * @test
     */
    public function testManyReels()
    {

        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")];

        $reel1 = new Reel($stops);

        $reel2 = new Reel($stops);

        $reel3 = new Reel($stops);

        $reels = new Reels([$reel1,$reel2,$reel3]);

        $payline = $reels->spin();

        $this->assertCount(3,$payline);

        foreach($payline as $result) {
            $this->assertContains($result->getSymbol(),$stops);
        }

    }

}
