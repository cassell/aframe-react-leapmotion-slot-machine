<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;
use Cassell\Casino\Slot\MultiplyWagerPayout;
use Cassell\Casino\Slot\WagerAmountPayout;
use Cassell\Casino\Slot\PayTable;
use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Reels;
use Cassell\Casino\Slot\SlotMachine;
use Cassell\Casino\Slot\Symbol;
use Cassell\Casino\Slot\WinOnNumberOfSymbols;

class SlotMachineTest extends \PHPUnit_Framework_TestCase
{
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

        $payTable = new PayTable([
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(1,new Symbol("A")),new Amount(2))
        ]);

        $slotMachine = new SlotMachine($reels,$payTable);

        for($i = 0; $i < 100; $i++){
            $result = $slotMachine->pull(new Wager(1));
            if($result->getAmountWon()->isPositive())
            {
                $this->assertEquals(2,$result->getAmountWon()->getAmount());
                return;
            }
        }

        throw new \Exception("Should have won once in 100 pulls");
    }


    /**
     * @test
     */
    public function test3ReelBet()
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C")];

        $reel1 = new Reel($stops);

        $reel2 = new Reel($stops);

        $reel3 = new Reel($stops);

        $reels = new Reels([$reel1,$reel2,$reel3]);

        $payTable = new PayTable([
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(1,new Symbol("A")),new Amount(2)),
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(3,new Symbol("A")),new Amount(10))
        ]);

        $slotMachine = new SlotMachine($reels,$payTable);

        for($i = 0; $i < 1000; $i++){
            $result = $slotMachine->pull(new Wager(1));
            if($result->getAmountWon()->getAmount() == 10)
            {
                return;
            }
        }

        throw new \Exception("Should have 10 won once in 100 pulls");
    }

    /**
     * @test
     */
    public function test3ReelBet1()
    {
        $this->spinWithWager(new Wager(1),new Amount(10));
    }

    /**
     * @test
     */
    public function test3ReelBet3()
    {
        $this->spinWithWager(new Wager(3),new Amount(30));
    }

    private function spinWithWager(Wager $wager,Amount $shouldWin)
    {
        $stops = [new Symbol("A"),
            new Symbol("B"),
            new Symbol("C")];

        $reel1 = new Reel($stops);

        $reel2 = new Reel($stops);

        $reel3 = new Reel($stops);

        $reels = new Reels([$reel1,$reel2,$reel3]);

        $payTable = new PayTable([
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(1,new Symbol("A")),new Amount(2)),
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(2,new Symbol("B")),new Amount(5)),
            new MultiplyWagerPayout(new WinOnNumberOfSymbols(3,new Symbol("A")),new Amount(10))
        ]);

        $slotMachine = new SlotMachine($reels,$payTable);

        for($i = 0; $i < 1000; $i++){
            $result = $slotMachine->pull($wager);
            if($result->getAmountWon()->equals($shouldWin))
            {
                return;
            }
        }

        throw new \Exception("Should have " . $shouldWin->getAmount() . " won once in 100 pulls");
    }




}