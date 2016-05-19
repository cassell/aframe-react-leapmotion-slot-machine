<?php
namespace Cassell\Casino\Currency;

/**
 * Class Amount
 * @package Cassell\Casino\Currency
 */
class Amount
{
    /**
     * @var int
     */
    private $intAmount;

    /**
     * Amount constructor.
     * @param $intAmount
     */
    public function __construct($intAmount)
    {
        $this->intAmount = (int) $intAmount;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->intAmount;
    }

    /**
     * @param  Amount $amount
     * @return Amount
     */
    public function addAmount(Amount $amount)
    {
        return new Amount($this->getAmount() + $amount->getAmount());
    }

    /**
     * @param  Amount $amount
     * @return Amount
     */
    public function reduceAmount(Amount $amount)
    {
        return new Amount($this->getAmount() - $amount->getAmount());
    }

    /**
     * @return bool
     */
    public function isPositive()
    {
        return $this->getAmount() > 0;
    }

    /**
     * @param Amount $amount
     * @return bool
     */
    public function equals(Amount $amount)
    {
        return $this->getAmount() == $amount->getAmount();
    }

    /**
     * @param Amount $amount
     * @return bool
     */
    public function lessThan(Amount $amount)
    {
        return $this->getAmount() < $amount->getAmount();
    }

}
