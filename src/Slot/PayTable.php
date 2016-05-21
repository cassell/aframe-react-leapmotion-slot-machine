<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;

class PayTable
{
    /**
     * @var Payout[]
     */
    private $payouts;

    public function __construct(array $payouts)
    {
        foreach ($payouts as $payout) {
            $this->addPayout($payout);
        }

    }

    public function addPayout(Payout $payout)
    {
        $this->payouts[] = $payout;
    }

    public function getAmountWon(Wager $wager, PayLine $payLine)
    {
        $max = new Amount(0);

        /** @var Payout $payout */
        foreach ($this->payouts as $payout) {

            if($max->lessThan($payout->amountWon($wager,$payLine))) {
                $max = $payout->amountWon($wager,$payLine);
            }

        }

        return $max;
    }

}
