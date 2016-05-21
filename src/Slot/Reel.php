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
     * @return ReelSpinResult
     */
    public function spin()
    {
        $position = array_rand($this->stops);
        $symbol = $this->stops[$position];
        return new ReelSpinResult($position + 1,$symbol);
    }

    public static function fromString($string)
    {
        $symbols = [];
        foreach(explode(" ",$string) as $str) {
            $symbols[] = new Symbol($str);
        }

        return new self($symbols);

    }

}
