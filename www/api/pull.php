<?php

use Cassell\Casino\Currency\Amount;
use Cassell\Casino\Currency\Balance;
use Cassell\Casino\Currency\Wager;
use Cassell\Casino\Slot\MultiplyWagerPayout;
use Cassell\Casino\Slot\PayTable;
use Cassell\Casino\Slot\Reel;
use Cassell\Casino\Slot\Reels;
use Cassell\Casino\Slot\ReelSpinResult;
use Cassell\Casino\Slot\Symbol;
use Cassell\Casino\Slot\WinOnCombinationOfSymbols;
use Cassell\Casino\Slot\WinOnNumberOfSymbols;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__ . "/../../vendor/autoload.php";

$session = new Session();
$session->start();

if($session->has('balance')) {
    $balance = $session->get('balance');
} else {
    $balance = new Balance(100);
}

$reel1 = Reel::fromString("php javascript html5 ruby python apache java net aframe");
$reel2 = Reel::fromString("php javascript html5 ruby python mysql java net aframe");
$reel3 = Reel::fromString("php javascript html5 ruby python lisp java net aframe");

$reels = new Reels([$reel1,$reel2,$reel3]);

$payTable = new PayTable([
    MultiplyWagerPayout::ThreeOfAKind("php",1024),
    MultiplyWagerPayout::ThreeOfAKind("javascript",512),
    MultiplyWagerPayout::ThreeOfAKind("html5",512),
    MultiplyWagerPayout::ThreeOfAKind("ruby",337),
    MultiplyWagerPayout::ThreeOfAKind("python",729),
    MultiplyWagerPayout::ThreeOfAKind("java",128),
    MultiplyWagerPayout::ThreeOfAKind("net",666),
    MultiplyWagerPayout::ThreeOfAKind("aframe",256),
    new MultiplyWagerPayout(new WinOnCombinationOfSymbols([
        new WinOnNumberOfSymbols(1,new Symbol("apache")),
        new WinOnNumberOfSymbols(1,new Symbol("mysql")),
        new WinOnNumberOfSymbols(1,new Symbol("php"))
    ]),new Amount(1024)),
    new MultiplyWagerPayout(new WinOnCombinationOfSymbols([
        new WinOnNumberOfSymbols(1,new Symbol("javascript")),
        new WinOnNumberOfSymbols(1,new Symbol("html5")),
        new WinOnNumberOfSymbols(1,new Symbol("php"))
    ]),new Amount(512)),
    MultiplyWagerPayout::TwoOfAKind("php",64),
    MultiplyWagerPayout::TwoOfAKind("javascript",32),
    MultiplyWagerPayout::TwoOfAKind("ruby",32),
    MultiplyWagerPayout::TwoOfAKind("html5",5),
    MultiplyWagerPayout::OneOfAKind("php",7),
    MultiplyWagerPayout::OneOfAKind("javascript",2),
    MultiplyWagerPayout::OneOfAKind("lisp",1)
]);


$slotMachine = new \Cassell\Casino\Slot\SlotMachine($reels,$payTable);

$request = Request::createFromGlobals();

$bet = new Wager($request->get('wager'));

$balance = $balance->reduceAmount($bet);

$result = $slotMachine->pull($bet);

$balance = $balance->addAmount($result->getAmountWon());

$data = [];
$data['balance'] = $balance->getAmount();
$data['win'] = $result->getAmountWon()->getAmount();
$data["reels"] = [];
/** @var ReelSpinResult $reelSpinResult */
foreach($result->getPayLine() as $reelSpinResult) {
    $data["reels"][] = ["position" => $reelSpinResult->getPosition(), "value" => $reelSpinResult->getSymbol()->getName()];
}

$session->set('balance',$balance);


$json = new \Symfony\Component\HttpFoundation\JsonResponse($data);
$json->send();