<?php

use Cassell\Casino\Currency\Balance;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__ . "/../../vendor/autoload.php";

$session = new Session();

if ($session->has('balance')) {
    $balance = $session->get('balance');
} else {
    $balance = new Balance(0);
}

$session->invalidate();

$json = new \Symfony\Component\HttpFoundation\JsonResponse(['credits' => $balance->getAmount()]);

$json->send();
