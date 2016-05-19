<?php
namespace Cassell\Casino\Slot;

class WinOnCombinationOfSymbols implements WinSpecification
{
    /**
     * @var WinSpecification[]
     */
    private $specs;

    /**
     * WinOnCombinationOfSymbols constructor.
     * @param WinSpecification[] $winSpecifications
     */
    public function __construct(array $winSpecifications)
    {
        foreach ($winSpecifications as $winSpecification) {
            $this->addToSpecification($winSpecification);
        }
    }

    private function addToSpecification(WinSpecification $winSpecification)
    {
        $this->specs[] = $winSpecification;
    }

    public function isSatisfied(PayLine $payLine)
    {
        foreach($this->specs as $spec) {
            if(! $spec->isSatisfied($payLine)) {
                return false;
            }
        }
        return true;
    }

}
