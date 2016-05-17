<?php
namespace Cassell\Casino\Slot;

class Reel
{
    /**
     * @var Symbol[]
     */
    private $stops;

    /**
     * Reel constructor.
     * @param Symbol[] $stops
     */
    public function __construct(array $stops = [])
    {
        foreach ($stops as $stop) {
            $this->addStop($stop);
        }
    }

    /**
     * @param Symbol $symbol
     */
    public function addStop(Symbol $symbol)
    {
        $this->stops[] = $symbol;
    }

    /**
     * @return int
     */
    public function getNumberOfStops()
    {
        return count($this->stops);
    }

    /**
     * @return Symbol
     */
    public function spin()
    {
        return $this->stops[array_rand($this->stops)];
    }

}
