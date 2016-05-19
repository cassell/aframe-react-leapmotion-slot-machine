<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\PayLine;
use Cassell\Casino\Slot\ReelSpinResult;
use Cassell\Casino\Slot\Symbol;
use Cassell\Casino\Slot\WinOnCombinationOfSymbols;
use Cassell\Casino\Slot\WinOnNumberOfSymbols;

class WinOnCombinationOfSymbolsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testFullHouseSymbolLoss()
    {
        $spec = new WinOnCombinationOfSymbols([
            new WinOnNumberOfSymbols(3,new Symbol("A")),
            new WinOnNumberOfSymbols(2,new Symbol("B"))
        ]);


        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("C"))]);

        $this->assertFalse($spec->isSatisfied($payline));
    }

    /**
     * @test
     */
    public function testFullHouseSymbolWin()
    {
        $spec = new WinOnCombinationOfSymbols([
            new WinOnNumberOfSymbols(3,new Symbol("A")),
            new WinOnNumberOfSymbols(2,new Symbol("B"))
        ]);

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("A"))]);

        $this->assertTrue($spec->isSatisfied($payline));
    }


}