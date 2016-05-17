<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Reels;
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

        $this->assertContains($reels->spin()->getResultForReelNumber(1),$stops);

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
        for ($i = 1; $i <= $reels->getCountOfReelsOnSlot(); $i++) {
            $this->assertContains($reels->spin()->getResultForReelNumber($i),$stops);
        }

    }

}
