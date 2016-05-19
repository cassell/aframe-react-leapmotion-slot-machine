<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;

interface Payout
{
    /**
     * @param Wager $wager
     * @return Amount
     */
    public function getAmountToWin(Wager $wager);

    /**
     * @param Wager $wager
     * @param PayLine $payLine
     * @return Amount
     */
    public function amountWon(Wager $wager, PayLine $payLine);
}