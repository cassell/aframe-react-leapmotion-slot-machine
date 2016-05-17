<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Reels;
use Cassell\Casino\Slot\SlotMachine;
use Cassell\Casino\Slot\Symbol;

class SlotMachineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testNegativeBet()
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")];

        $reel1 = new Reel($stops);

        $reels = new Reels([$reel1]);

        $slotMachine = new SlotMachine($reels);

        $slotMachine->pull(new Amount(-10));

    }

    /**
     * @test
     */
    public function testZeroBet()
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")];

        $reel1 = new Reel($stops);

        $reels = new Reels([$reel1]);

        $slotMachine = new SlotMachine($reels);

        $slotMachine->pull(new Amount(0));

    }

    /**
     * @test
     */
    public function testOneBet()
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C"),
            new Symbol("D"),
            new Symbol("E")];

        $reel1 = new Reel($stops);

        $reels = new Reels([$reel1]);

        $slotMachine = new SlotMachine($reels);

        $slotMachine->pull(new Amount(1));

    }


}