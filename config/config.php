<?php

namespace anna\Session;

// require __DIR__ . "/../src/Session/Session.php";

// require __DIR__ . "/anna/Session.php";
// require "Session.php";

// Starts the session and gives it a unique name:
// $name = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
// $name = "MinForhoppningsvisHeltUnikaAnnaSession";
// Session::setName($sessionName);
// Session::start();
// $session = new Session($name);
$app->session->getSessionName();
$app->session->start($app->session->getSessionName());
// echo("\$app->session->getSessionName() = " . $app->session->getSessionName());      // Fungerar!


$data = [
    "Session name" => session_name(),
    "Session id" => session_id(),
    "Session cache expire" => session_cache_expire(),
    "Session status" => session_status(),
    "Session cookie parameters" => session_get_cookie_params()
];

// echo($data["Session name"] . " " . $data["Session id"]);
