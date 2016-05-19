<?php
namespace Cassell\Casino\Slot;

interface WinSpecification
{
    /**
     * @param PayLine $payLine
     * @return bool
     */
    public function isSatisfied(PayLine $payLine);

}
