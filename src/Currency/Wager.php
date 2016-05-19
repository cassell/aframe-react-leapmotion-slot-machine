<?php
namespace Cassell\Casino\Currency;

class Wager extends Amount
{
    public function __construct($amount)
    {
        parent::__construct($amount);

        if(!$this->isPositive()) {
            throw new \Exception("Wager must be a positive amount");
        }
    }

}