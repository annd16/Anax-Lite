<?php

$civ = @curl_version();
$cvn = $civ["version_number"];
if ($cvn) {
    echo "curl installed";
} else {
    echo "curl is not installed";
}
