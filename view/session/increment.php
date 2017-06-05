<?php

$dir = __DIR__ . "/../../config";
require "$dir/config.php";

// echo $sessionNumber;

// $sessionNumber = $session->get("sessionNumber");
$sessionNumber = $app->session->get("sessionNumber");

$sessionNumber += 1;

$app->session->set("sessionNumber", $sessionNumber);



header("Location: " . $app->request->getBaseUrl() . "/session");
