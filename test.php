<?php
require_once('Client.php');
$token = 'TOKEN';
$client = new \Benyazi\VscaleApi\Client($token);
$balance = $client->getBillingBalance();
$plans = $client->getBillingPrices()["default"];
$scalets = $client->getScalets();
foreach ($scalets as $scalet) {
    $pricePerHour = $plans[$scalet['rplan']]['hour'];
    $hours = $balance['balance']/$pricePerHour;
    if($hours > 24) {
        $days = $hours/24;
        echo 'Scalet #' . $scalet['name'] . ', still days: ' . round($days) . 'd';
    } else {
        echo 'Scalet #' . $scalet['name'] . ', still hours: ' . round($hours) . 'h';
    }
}
