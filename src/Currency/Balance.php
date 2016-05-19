<?php
namespace Cassell\Casino\Currency;

class Balance extends Amount
{
    public function __construct($amount)
    {
        parent::__construct($amount);

        if($this->lessThan(new Amount(0))) {
            throw new \Exception("Balance can't be negative");
        }
    }

    public function reduceAmount(Amount $amount)
    {
        $newBalance = parent::reduceAmount($amount);

        if($newBalance->lessThan(new Amount(0))) {
            throw new \Exception("Balance can not go below zero");
        }

        return $newBalance;

    }


}