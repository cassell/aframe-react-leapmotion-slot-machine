<?php

use Cassell\Casino\Currency\Balance;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__ . "/../../vendor/autoload.php";

$session = new Session();
$session->start();

if (!$session->has('balance')) {
    $session->set('balance', new Balance(100));
}

$json = new \Symfony\Component\HttpFoundation\JsonResponse(['balance' => $session->get('balance')->getAmount()]);

$json->send();
