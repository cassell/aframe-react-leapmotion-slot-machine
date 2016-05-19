<?php
namespace Cassell\Test\Casino\Slot;

use Cassell\Casino\Slot\PayLine;
use Cassell\Casino\Slot\ReelSpinResult;
use Cassell\Casino\Slot\SpinResults;
use Cassell\Casino\Slot\Symbol;
use Cassell\Casino\Slot\WinOnNumberOfSymbols;

class WinOnNumberOfSymbolsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testOneSymbol()
    {
        $spec = new WinOnNumberOfSymbols(1,new Symbol("A"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A"))]);

        $this->assertTrue($spec->isSatisfied($payline));
    }

    /**
     * @test
     */
    public function testOneSymbolLoss()
    {
        $spec = new WinOnNumberOfSymbols(1,new Symbol("A"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("B"))]);

        $this->assertFalse($spec->isSatisfied($payline));
    }


    /**
     * @test
     */
    public function testOneSymbolMultiReelWin()
    {
        $spec = new WinOnNumberOfSymbols(1,new Symbol("A"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("C")),
            new ReelSpinResult(1,new Symbol("D")),
            new ReelSpinResult(1,new Symbol("E"))]);

        $this->assertTrue($spec->isSatisfied($payline));
    }

    /**
     * @test
     */
    public function testOneSymbolMultiReelLoss()
    {
        $spec = new WinOnNumberOfSymbols(1,new Symbol("F"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(11,new Symbol("B")),
            new ReelSpinResult(15,new Symbol("C")),
            new ReelSpinResult(61,new Symbol("D")),
            new ReelSpinResult(11,new Symbol("E"))]);

        $this->assertFalse($spec->isSatisfied($payline));
    }

    /**
     * @test
     */
    public function testThreeOfAKindSymbolWin()
    {
        $spec = new WinOnNumberOfSymbols(3,new Symbol("A"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("D")),
            new ReelSpinResult(1,new Symbol("E"))]);

        $this->assertTrue($spec->isSatisfied($payline));
    }

    /**
     * @test
     */
    public function testThreeOfAKindSymbolLoss()
    {
        $spec = new WinOnNumberOfSymbols(3,new Symbol("A"));

        $payline = new PayLine([new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("A")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("B")),
            new ReelSpinResult(1,new Symbol("B"))]);

        $this->assertFalse($spec->isSatisfied($payline));
    }

}