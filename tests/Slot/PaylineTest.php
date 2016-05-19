<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\PayLine;
use Cassell\Casino\Slot\ReelSpinResult;
use Cassell\Casino\Slot\Symbol;

class PaylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testPayline()
    {
        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(2,new Symbol("B")),
            new ReelSpinResult(3,new Symbol("C")),
            new ReelSpinResult(4,new Symbol("D")),
            new ReelSpinResult(5,new Symbol("E"))]);

        $this->assertCount(5,$payline);
        $count = 0;
        foreach($payline as $symbol) {
            $count++;
        }
        foreach($payline as $symbol) {
            $count++;
        }
        $this->assertEquals(10,$count);
    }


}