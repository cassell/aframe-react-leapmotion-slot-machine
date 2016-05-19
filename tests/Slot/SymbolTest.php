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

    /**
     * @test
     */
    public function testEquals()
    {
        $symbol = new Symbol("123");
        $this->assertTrue($symbol->equals(new Symbol("123")));
    }

}
