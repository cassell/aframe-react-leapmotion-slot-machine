<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;

class SlotMachineResult
{
    /**
     * @var PayLine
     */
    private $payLine;
    /**
     * @var Amount
     */
    private $won;

    public function __construct(PayLine $payLine, Amount $won)
    {
        $this->payLine = $payLine;
        $this->won = $won;
    }

    /**
     * @return PayLine
     */
    public function getPayLine()
    {
        return $this->payLine;
    }

    /**
     * @return Amount
     */
    public function getAmountWon()
    {
        return $this->won;
    }

}