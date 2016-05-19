<?php
namespace Cassell\Casino\Slot;

class ReelSpinResult
{
    /**
     * @var int
     */
    private $position;
    /**
     * @var Symbol
     */
    private $symbol;

    /**
     * ReelSpinResult constructor.
     * @param int $position
     * @param Symbol $symbol
     */
    public function __construct($position, $symbol)
    {
        $this->position = $position;
        $this->symbol = $symbol;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return Symbol
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

}