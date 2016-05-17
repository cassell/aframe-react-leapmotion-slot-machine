<?php

namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\Symbol;

class SymbolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testSymbolName()
    {
        $symbol = new Symbol("ABCDEFG");
        $this->assertEquals("ABCDEFG",$symbol->getName());
    }

}
