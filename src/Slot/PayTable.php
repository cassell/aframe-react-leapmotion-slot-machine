<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;

class PayTable
{
    public function getAmountWon(Wager $wager, PayLine $payLine)
    {
        $max = new Amount(0);

        return $max;
    }

}
