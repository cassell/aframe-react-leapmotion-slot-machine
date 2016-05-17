<?php
namespace Cassell\Casino\Slot;

class Reels
{
    /**
     * @var Reel[]
     */
    private $reels;

    /**
     * Reels constructor.
     * @param  Reel[]     $reels
     * @throws \Exception
     */
    public function __construct(array $reels)
    {
        if (count($reels) < 1) {
            throw new \Exception("Slot Machine Must Have One Reel or More");
        }

        foreach ($reels as $reel) {
            $this->addReel($reel);
        }
    }

    public function spin()
    {
        $results = [];
        foreach ($this->reels as $reel) {
            $results[] = $reel->spin();
        }

        return new SpinResults($results);

    }

    /**
     * @return int
     */
    public function getCountOfReelsOnSlot()
    {
        return count($this->reels);
    }

    private function addReel(Reel $reel)
    {
        $this->reels[] = $reel;
    }

}
