<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Wager;

/**
 * Class SlotMachine
 * @package Cassell\Casino\Slot
 */
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

    /**
     * SlotMachine constructor.
     * @param Reels $reels
     * @param PayTable $payTable
     */
    public function __construct(Reels $reels, PayTable $payTable)
    {
        $this->reels = $reels;
        $this->payTable = $payTable;
    }

    /**
     * @param  Wager $wager
     * @return SlotMachineResult
     */
    public function pull(Wager $wager)
    {
        $payline = $this->reels->spin();
        $won = $this->payTable->getAmountWon($wager, $payline);

        return new SlotMachineResult($payline, $won);
    }

}
