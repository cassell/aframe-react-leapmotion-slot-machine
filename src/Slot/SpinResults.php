<?php
namespace Cassell\Casino\Slot;

class SpinResults
{

    /**
     * @var Symbol[]
     */
    private $reelResults;

    public function __construct(array $reelResults)
    {
        if (count($reelResults) < 1) {
            throw new \Exception("Slot Machine Must Have One Reel or More");
        }

        foreach($reelResults as $reelResult) {
            $this->addResult($reelResult);
        }
    }

    private function addResult(Symbol $reelResult)
    {
        $this->reelResults[] = $reelResult;
    }

    public function getResultForReelNumber($reelNumber)
    {
       return $this->reelResults[$reelNumber - 1];
    }



}