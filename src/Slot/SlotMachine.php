<?php
namespace Cassell\Casino\Slot;

use Cassell\Casino\Currency\Amount;

class SlotMachine
{
    /**
     * @var Reels
     */
    private $reels;

    public function __construct(Reels $reels)
    {
        $this->reels = $reels;
    }

    public function pull(Amount $bet)
    {
        if (! $bet->isPositive()) {

        }
        $result = $this->reels->spin();

    }

}
