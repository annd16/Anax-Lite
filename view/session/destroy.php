<?php

$dir = __DIR__ . "/../../config";
require "$dir/config.php";

$app->session->destroy();

header("Location: " . $app->request->getBaseUrl() . "/session/dump");
