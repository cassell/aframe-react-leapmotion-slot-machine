<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Wager;

class SlotMachine
{
    /**
     * @var Reels
     */
    private $reels;
    /**
     * @var PayTable
     */
    private $payTable;

    public function __construct(Reels $reels, PayTable $payTable)
    {
        $this->reels = $reels;
        $this->payTable = $payTable;
    }

    public function pull(Wager $wager)
    {
        $payline = $this->reels->spin();
        $won = $this->payTable->getAmountWon($wager,$payline);
        return new SlotMachineResult($wager,$payline, $won);
    }

}
