<?php
/**
 * Routes.
 */


//  Två routes som returnerar varsin HTML-sida.

// Notera att callbacken för routen nu använder function () use ($app) vilket gör att callbacken
// får tillgång till variabeln $app som innehåller alla ramverkets resurser.
// $app->router->add("", function () use ($app) {
//     $urlHome  = $app->url->create("");
//     $urlAbout = $app->url->create("about");
//     $navbar = <<<EOD
// <navbar>
//     <a href="$urlHome">Home</a> |
//     <a href="$urlAbout">About</a>
// </navbar>
// EOD;
//     $body = <<<EOD
// <!doctype html>
// <meta charset="utf-8">
// <title>Home</title>
// $navbar
// <h1>Home</h1>
// <p>This is the homepage.</p>
// EOD;
//
//     //echo $body;
//     // Klassen response tar hand om utskriften av resultatet, svaret
//     $app->response->setbody($body)
//                   ->send();
// });


// $app->router->add efter att vi flyttat kod från home-routen till en vy istället.
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Home"]);
    $app->view->add("take1/navbar");
    $app->view->add("take1/home");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// $app->router->add efter att vi flyttat kod från about-routen till en vy istället.
$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => "About"]);
    $app->view->add("take1/navbar");
    $app->view->add("take1/about");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


// Route som skickar ett JSON-objekt som svar.
$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];

    $app->response->sendJson($data);
});


// Man kan skapa routes som är dynamiska och skickar med en parameter till routens callback.
// Route med parametrar
$app->router->add("search/{string}", function ($string) use ($app) {
    $data = [
        "Searchstring was" => $string
    ];

    $app->response->sendJson($data);
});


// Route med parametrar som kollar om parametern är av viss typ och ger olika svar beroende på typ...

/**
 * Check arguments that matches a specific type.
 */
$callback = function ($value) use ($app) {
    $data = [
        "route"     => $app->request->getRoute(),
        "matched"   => $app->router->getLastRoute(),
        "value"     => $value,
    ];

    $app->response->sendJson($data);
};

$app->router->add("validate/{value:digit}", $callback);
$app->router->add("validate/{value:hex}", $callback);
$app->router->add("validate/{value:alpha}", $callback);
$app->router->add("validate/{value:alphanum}", $callback);
