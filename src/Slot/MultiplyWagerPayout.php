<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Wager;

class MultiplyWagerPayout implements Payout
{
    /**
     * @var Amount
     */
    private $amountToPayForWagerOfOne;

    /**
     * @var WinSpecification
     */
    private $winSpecification;

    public function __construct(WinSpecification $winSpecification, Amount $amountToPayForWagerOfOne)
    {
        $this->amountToPayForWagerOfOne = $amountToPayForWagerOfOne;
        $this->winSpecification = $winSpecification;
    }

    /**
     * @param  Wager $wager
     * @return Amount
     */
    public function getAmountToWin(Wager $wager)
    {
        return new Amount($wager->getAmount() * $this->amountToPayForWagerOfOne->getAmount());
    }

    /**
     * @param  Wager $wager
     * @param  PayLine $payLine
     * @return Amount
     */
    public function amountWon(Wager $wager, PayLine $payLine)
    {
        if ($this->winSpecification->isSatisfied($payLine)) {
            return $this->getAmountToWin($wager);
        }

        return new Amount(0);
    }

    /**
     * @return WinSpecification
     */
    public function getWinSpecification()
    {
        return $this->winSpecification;
    }

    public static function TwoOfAKind($kind, $multiplier)
    {
        return new self(new WinOnNumberOfSymbols(3, new Symbol($kind)), new Amount($multiplier));
    }

    public static function ThreeOfAKind($kind, $multiplier)
    {
        return new self(new WinOnNumberOfSymbols(3, new Symbol($kind)), new Amount($multiplier));
    }

    public static function OneOfAKind($kind, $multiplier)
    {
        return new self(new WinOnNumberOfSymbols(1, new Symbol($kind)), new Amount($multiplier));
    }

}
