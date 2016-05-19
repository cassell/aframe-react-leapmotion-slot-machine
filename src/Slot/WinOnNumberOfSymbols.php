<?php
namespace Cassell\Casino\Slot;

class WinOnNumberOfSymbols implements WinSpecification
{
    /**
     * @var
     */
    private $requiredCount;
    /**
     * @var Symbol
     */
    private $symbol;

    public function __construct($count, Symbol $symbol)
    {
        $this->requiredCount = $count;
        $this->symbol = $symbol;
    }

    /**
     * @param  PayLine $payLine
     * @return bool
     */
    public function isSatisfied(PayLine $payLine)
    {
        $count = 0;

        /** @var ReelSpinResult $result */
        foreach ($payLine as $result) {
            if ($this->symbol->equals($result->getSymbol())) {
                $count++;
            }
        }

        return $count >= $this->requiredCount;

    }

}
