<?php
/**
 * Routes.
 */

$app->router->add("session/increment", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("session/navbar3");
    $app->view->add("session/increment", [
        "title" => "Increment",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


$app->router->add("session/decrement", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("session/navbar3");
    $app->view->add("session/decrement", [
        "title" => "Decrement",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// Route som skickar ett JSON-objekt som svar.
$app->router->add("session/status", function () use ($app) {
    
    $app->session->start($app->session->getSessionName());
    echo($app->session->getSessionName());
    $data = [
        "Session name" => session_name(),
        "Session id" => session_id(),
        "Session cache expire" => session_cache_expire(),
        "Session status" => session_status(),
        "Session cookie parameters" => session_get_cookie_params(),
    ];
    $app->response->sendJson($data);
});

// PHP_SESSION_DISABLED if sessions are disabled. _DISABLED = 0
// PHP_SESSION_NONE if sessions are enabled, but none exists. _NONE = 1
// PHP_SESSION_ACTIVE if sessions are enabled, and one exists. _ACTIVE = 2


$app->router->add("session/dump", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("session/navbar3");
    $app->view->add("session/dump", [
        "title" => "Dump",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/destroy", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("session/destroy", [
        "title" => "Destroy",
        "message" => "Hello World",
    "answer" => 42
    ]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
