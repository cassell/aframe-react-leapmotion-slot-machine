<?php
namespace Cassell\Casino\Slot;

class PayLine extends \SplFixedArray implements \Iterator, \Countable
{
    public function __construct(array $reelResults)
    {
        parent::__construct(count($reelResults));
        $i = 0;
        foreach($reelResults as $reelResult) {
            $this->addReelResult($i++,$reelResult);
        }
    }

    /**
     * Throw when the type of item is not accepted.
     *
     * @param $offset
     * @param ReelSpinResult $reelResult
     */
    protected function addReelResult($offset, ReelSpinResult $reelResult)
    {
        parent::offsetSet($offset, $reelResult);
    }


    final public function count()
    {
        return parent::count();
    }
    final public function current()
    {
        return parent::current();
    }
    final public function key()
    {
        return parent::key();
    }
    final public function next()
    {
        parent::next();
    }
    final public function rewind()
    {
        parent::rewind();
    }
    final public function valid()
    {
        return parent::valid();
    }
    final public function offsetExists($offset)
    {
        return parent::offsetExists($offset);
    }
    final public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }
    final public function offsetSet($offset, $value)
    {
        throw new \Exception("PayLine array is immutable");
    }
    final public function offsetUnset($offset)
    {
        throw new \Exception("PayLine array is immutable");
    }

}
